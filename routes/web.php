<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Students;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmed;
use App\Mail\BorrowRequestApproved;
use App\Mail\BorrowRequestRejected;
use App\Mail\BookDueDateNotice;
use App\Mail\BookReturnedSuccessfully;

// Redirect root to login
Route::redirect('/', '/login');

// Protected Student Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books', function () {
        $categoryNames = [
            1 => 'Mathematics', 2 => 'Science',    3 => 'Literature',
            4 => 'History',     5 => 'Geography',  6 => 'ICT',
            7 => 'Fiction',     8 => 'Non-Fiction', 9 => 'Biography',
            10 => 'Arts',       11 => 'Sports',    12 => 'Reference',
        ];

        $search = request('search', '');
        $category = request('category', '');

        $query = \App\Models\Book::query();

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $books = $query->get();
        return view('books', compact('books', 'categoryNames', 'category'));
    })->name('books');
    
    // Keep old route for backward compatibility - redirects to query parameter style
    Route::get('/books/{id}', function ($id) {
        return redirect()->route('books', ['category' => $id] + request()->except('id'));
    })->name('books.category');
    Route::get('/category', function () {
        return view('category');
    });
    Route::get('/availability', function () {
        $categoryNames = [
            1 => 'Mathematics', 2 => 'Science',    3 => 'Literature',
            4 => 'History',     5 => 'Geography',  6 => 'ICT',
            7 => 'Fiction',     8 => 'Non-Fiction', 9 => 'Biography',
            10 => 'Arts',       11 => 'Sports',    12 => 'Reference',
        ];
        $books = \App\Models\Book::all();
        return view('availability', compact('books', 'categoryNames'));
    });

    Route::get('/borrowed-books', function () {
        $dueIssues = \App\Models\Issue::with('book', 'student')
            ->where('student_id', Auth::id())
            ->whereIn('status', ['Approved', 'Borrowed'])
            ->whereDate('due_date', '<=', now()->toDateString())
            ->whereNull('due_notice_sent_at')
            ->get();

        foreach ($dueIssues as $dueIssue) {
            \App\Models\Message::firstOrCreate(
                [
                    'user_id' => $dueIssue->student_id,
                    'issue_id' => $dueIssue->id,
                    'type' => 'due_date',
                ],
                [
                    'title' => 'Book Due Date Notice',
                    'body' => "The book you borrowed is on due date.\n\nBook Title: {$dueIssue->book->title}\nBook ID: " . ($dueIssue->book->book_id ?? $dueIssue->book->id) . "\nStudent ID: {$dueIssue->student_id}\nBorrow Date & Time: " . \Carbon\CarbonImmutable::parse($dueIssue->borrow_date)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') . "\nDue Date: " . \Carbon\CarbonImmutable::parse($dueIssue->due_date)->setTimezone(config('app.timezone'))->format('M d, Y'),
                ]
            );

            try {
                if ($dueIssue->student && $dueIssue->student->email) {
                    Mail::to($dueIssue->student->email)->send(new BookDueDateNotice(
                        $dueIssue->book->title,
                        $dueIssue->book->book_id ?? $dueIssue->book->id,
                        $dueIssue->student_id,
                        $dueIssue->student->name,
                        $dueIssue->borrow_date,
                        $dueIssue->due_date
                    ));

                    $dueIssue->update(['due_notice_sent_at' => now()]);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send due date email: ' . $e->getMessage());
            }
        }

        $issues = \App\Models\Issue::with('book')
            ->where('student_id', Auth::id())
            ->whereIn('status', ['Pending', 'Approved', 'Borrowed'])
            ->orderBy('due_date', 'asc')
            ->get();
        return view('Borrowed Books', compact('issues'));
    })->name('borrowed.books');

    Route::get('/messages', function () {
        $messages = \App\Models\Message::with('issue.book', 'issue.student')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        \App\Models\Message::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('message', compact('messages'));
    })->name('student.messages');

    // Student reserve book
    Route::post('/reserve', function (Request $request) {
        $validated = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $book = \App\Models\Book::findOrFail($validated['book_id']);

        if ($book->status !== 'Available') {
            return back()->with('error', 'Book is not available for reservation.');
        }

        // Prevent duplicate active requests/borrows for same student and book
        $existingIssue = \App\Models\Issue::where('book_id', $book->id)
            ->where('student_id', Auth::id())
            ->whereIn('status', ['Pending', 'Approved', 'Borrowed'])
            ->first();

        if ($existingIssue) {
            return back()->with('error', 'You already have a request or borrowing for this book.');
        }

        // Create a borrow request
        $issue = \App\Models\Issue::create([
            'student_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(4),
            'status' => 'Pending',
        ]);

        // Update book status to Reserved
        $book->update(['status' => 'Reserved']);

        // Send confirmation email to student
        try {
            Mail::to(Auth::user()->email)->send(new ReservationConfirmed(
                $book->title,
                $book->book_id ?? $book->id,
                Auth::user()->name,
                Auth::id(),
                now()->toDateString(),
                now()->addDays(4)->toDateString()
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send reservation email: ' . $e->getMessage());
        }

        return back()->with('success', 'Book reserved! Your borrow request is pending admin approval. A confirmation email has been sent to your inbox.');
    })->name('reserve.book');

    // Student submit borrow request (legacy - currently not used)
    Route::post('/borrow-request', function (Request $request) {
        $book = \App\Models\Book::findOrFail($request->book_id);

        if ($book->status !== 'Reserved') {
            return back()->with('error', 'Book must be reserved first.');
        }

        $issue = \App\Models\Issue::where('book_id', $book->id)
            ->where('student_id', Auth::id())
            ->where('status', 'Pending')
            ->first();

        if (!$issue) {
            $issue = \App\Models\Issue::create([
                'student_id' => Auth::id(),
                'book_id' => $book->id,
                'borrow_date' => now(),
                'due_date' => now()->addDays(4),
                'status' => 'Pending',
            ]);
        }

        return back()->with('success', 'Borrow request submitted! Waiting for admin approval.');
    })->name('borrow.request');

    Route::post('/admin/approve-borrow/{id}', function ($id) {
        $issue = \App\Models\Issue::with('student', 'book')->findOrFail($id);

        if ($issue->status !== 'Pending') {
            return back()->with('error', 'Request already processed.');
        }

        // Approve means book is now officially borrowed
        $issue->update(['status' => 'Borrowed', 'borrow_date' => now()]);
        $issue->book->update(['status' => 'Borrowed']);
        $issue->refresh()->load('student', 'book');

        \App\Models\Message::firstOrCreate(
            [
                'user_id' => $issue->student_id,
                'issue_id' => $issue->id,
                'type' => 'borrow_approved',
            ],
            [
                'title' => 'Borrow Request Approved',
                'body' => "Your borrow request has been approved.\n\nBook Title: {$issue->book->title}\nBook ID: " . ($issue->book->book_id ?? $issue->book->id) . "\nStudent ID: {$issue->student_id}\nBorrow Date & Time: " . \Carbon\CarbonImmutable::parse($issue->borrow_date)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') . "\nDue Date: " . \Carbon\CarbonImmutable::parse($issue->due_date)->setTimezone(config('app.timezone'))->format('M d, Y'),
            ]
        );

        // Send approval email to student
        try {
            if ($issue->student && $issue->student->email) {
                Mail::to($issue->student->email)->send(new BorrowRequestApproved(
                    $issue->book->title,
                    $issue->book->book_id ?? $issue->book->id,
                    $issue->student_id,
                    $issue->student->name,
                    $issue->borrow_date,
                    $issue->due_date
                ));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email: ' . $e->getMessage());
        }

        return back()->with('success', 'Borrow request approved! Student has been notified.');
    })->name('admin.approve.borrow');

    Route::post('/admin/reject-borrow/{id}', function ($id) {
        $issue = \App\Models\Issue::with('student')->findOrFail($id);

        if ($issue->status !== 'Pending') {
            return back()->with('error', 'Request already processed.');
        }

        $issue->update(['status' => 'Rejected']);
        $issue->book->update(['status' => 'Available']);

        // Send rejection email to student
        try {
            if ($issue->student && $issue->student->email) {
                Mail::to($issue->student->email)->send(new BorrowRequestRejected(
                    $issue->book->title,
                    $issue->student->name
                ));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send rejection email: ' . $e->getMessage());
        }

        return back()->with('success', 'Borrow request rejected. Student has been notified.');
    })->name('admin.reject.borrow');

    Route::post('/borrow', function (Request $request) {
        // Validate input
        $validated = $request->validate([
            'student_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,id',
            'borrow_date' => 'nullable|date',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $book = \App\Models\Book::findOrFail($validated['book_id']);
        $studentId = $validated['student_id'];

        // Check for existing active issue (Pending, Approved, Borrowed)
        $existingIssue = \App\Models\Issue::where('book_id', $book->id)
            ->where('student_id', $studentId)
            ->whereIn('status', ['Pending', 'Approved', 'Borrowed'])
            ->first();

        if ($existingIssue) {
            return back()->with('error', 'This student already has an active request or borrowing for this book.');
        }

        if ($book->status === 'Available') {
            // Admin direct issue
            $issue = \App\Models\Issue::create([
                'student_id' => $studentId,
                'book_id' => $book->id,
                'borrow_date' => now(),
                'due_date' => $validated['due_date'],
                'status' => 'Borrowed',
            ]);
            $book->update(['status' => 'Borrowed']);

            return back()->with('success', 'Book issued successfully to student!');
        }

        // Reserved book flow: student must have an Approved issue
        if ($book->status === 'Reserved') {
            $issue = \App\Models\Issue::where('book_id', $book->id)
                ->where('student_id', $studentId)
                ->where('status', 'Approved')
                ->first();

            if (!$issue) {
                return back()->with('error', 'No approved borrow request found for this student. Admin must approve the request first.');
            }

            $issue->update(['status' => 'Borrowed', 'borrow_date' => now()]);
            $book->update(['status' => 'Borrowed']);

            return back()->with('success', 'Book borrowed successfully!');
        }

        return back()->with('error', 'Book is not available for borrowing. Current status: ' . $book->status);
    })->name('borrow.book');

    Route::post('/return', function (Request $request) {
        $book = \App\Models\Book::findOrFail($request->book_id);
        $studentId = $request->student_id;

        // The book must be Borrowed (or Approved) to be returned
        if (!in_array($book->status, ['Borrowed', 'Approved'])) {
            return back()->with('error', 'Book is not currently borrowed.');
        }

        // Find the active issue (Borrowed or Approved) for this student and book
        $issue = \App\Models\Issue::where('book_id', $book->id)
            ->where('student_id', $studentId)
            ->whereIn('status', ['Borrowed', 'Approved'])
            ->first();

        if ($issue) {
            $issue->update(['status' => 'Returned', 'return_date' => now()]);
            $issue->load('book', 'student');

            \App\Models\Message::firstOrCreate(
                [
                    'user_id' => $issue->student_id,
                    'issue_id' => $issue->id,
                    'type' => 'book_returned',
                ],
                [
                    'title' => 'Book Returned Successfully',
                    'body' => "The book you borrowed has been successfully returned.\n\nBook Title: {$issue->book->title}\nBook ID: " . ($issue->book->book_id ?? $issue->book->id) . "\nStudent ID: {$issue->student_id}\nBorrow Date & Time: " . \Carbon\CarbonImmutable::parse($issue->borrow_date)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') . "\nReturn Date & Time: " . \Carbon\CarbonImmutable::parse($issue->return_date)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A'),
                ]
            );

            try {
                if ($issue->student && $issue->student->email) {
                    Mail::to($issue->student->email)->send(new BookReturnedSuccessfully(
                        $issue->book->title,
                        $issue->book->book_id ?? $issue->book->id,
                        $issue->student_id,
                        $issue->student->name,
                        $issue->borrow_date,
                        $issue->return_date
                    ));
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send returned book email: ' . $e->getMessage());
            }
        }

        // Mark book as Available
        $book->update(['status' => 'Available']);

        return back()->with('success', 'Book returned successfully!');
    })->name('return.book');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes (require admin authentication)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', function () {
        $totalBooks = \App\Models\Book::count();
        $totalStudents = \App\Models\User::where('role', 'student')->count();
        $booksBorrowed = \App\Models\Book::where('status', 'Borrowed')->count();
        $pendingRequests = \App\Models\Issue::where('status', 'Pending')->count();
        
        $recentBorrowed = \App\Models\Issue::with(['book', 'student'])
            ->whereIn('status', ['Borrowed', 'Approved'])
            ->orderBy('borrow_date', 'desc')
            ->take(5)
            ->get();

        $dueBooks = \App\Models\Issue::with(['book', 'student'])
            ->where('status', 'Borrowed')
            ->where('due_date', '<=', \Carbon\Carbon::now()->addDays(7)->toDateString())
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        return view('home', compact('totalBooks', 'totalStudents', 'booksBorrowed', 'pendingRequests', 'recentBorrowed', 'dueBooks'));
    })->name('admin.home');

    Route::get('/Home', function () {
        return redirect()->route('admin.home');
    });

    Route::get('/pending-requests', function () {
        $pendingRequests = \App\Models\Issue::with('book', 'student')
            ->where('status', 'Pending')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('pending-requests', compact('pendingRequests'));
    })->name('admin.pending.requests');

    Route::get('/logs', function () {
        $validated = request()->validate([
            'student_id' => 'nullable|integer|min:1',
        ]);
        $studentIdFilter = $validated['student_id'] ?? null;

        $logs = \App\Models\LoginTracker::with('user')
            ->when($studentIdFilter, fn ($query) => $query->where('user_id', $studentIdFilter))
            ->latest('login_time')
            ->get();

        $issueLogs = \App\Models\Issue::with('book', 'student')
            ->whereIn('status', ['Borrowed', 'Returned', 'Approved', 'Rejected'])
            ->when($studentIdFilter, fn ($query) => $query->where('student_id', $studentIdFilter))
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('logs', compact('logs', 'issueLogs', 'studentIdFilter'));
    })->name('admin.logs');

    Route::get('/Student', function () {
        $borrowSearch = trim((string) request('search', ''));
        $students = Students::all();

        $borrowedIssues = \App\Models\Issue::with('book', 'student')
            ->whereIn('status', ['Borrowed', 'Approved'])
            ->when($borrowSearch, function ($query) use ($borrowSearch) {
                $query->where(function ($query) use ($borrowSearch) {
                    $query->where('student_id', $borrowSearch)
                        ->orWhereHas('book', function ($query) use ($borrowSearch) {
                            $query->where('book_id', $borrowSearch);
                        });
                });
            })
            ->orderBy('due_date', 'asc')
            ->get();

        return view('student', compact('students', 'borrowedIssues', 'borrowSearch'));
    })->name('admin.students');

    Route::get('/Library', function () {
        $books = \App\Models\Book::all();
        return view('library', ['books' => $books]);
    })->name('admin.library');

Route::post('/library/add', function (Request $request) {
        \App\Models\Book::create([
            'name' => $request->name,
            'writer' => $request->writer,
            'book_id' => $request->book_id,
            'subject' => $request->subject,
            'date' => $request->date,
            'title' => $request->name,
            'author' => $request->writer,
            'category_id' => $request->category_id,
            'cover' => 'book1.jpg',
            'description' => '',
            'status' => 'Available',
            'class' => '',
        ]);
        return redirect()->back();
    })->name('admin.library.add');

    Route::delete('/library/delete/{id}', function ($id) {
        \App\Models\Book::findOrFail($id)->delete();
        return redirect()->back();
    })->name('admin.library.delete');
});

// Public Routes (no authentication required)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('login.admin');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('login.admin.post');
});


// try lang ni sya 
