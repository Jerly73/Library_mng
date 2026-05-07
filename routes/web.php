<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Students;

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

        $books = \App\Models\Book::all();
        return view('books', compact('books', 'categoryNames'));
    })->name('books');
    Route::get('/books/{id}', function ($id) {
        $categoryNames = [
            1 => 'Mathematics', 2 => 'Science',    3 => 'Literature',
            4 => 'History',     5 => 'Geography',  6 => 'ICT',
            7 => 'Fiction',     8 => 'Non-Fiction', 9 => 'Biography',
            10 => 'Arts',       11 => 'Sports',    12 => 'Reference',
        ];

        $allBooks = \App\Models\Book::all()->toArray();

        $categoryId = $id;
        $search = request('search', '');

        $books = array_filter($allBooks, function($book) use ($categoryId, $search, $categoryNames) {
            $matchCategory = !$categoryId || $book['category_id'] == $categoryId;
            $matchSearch = !$search ||
                stripos($book['title'], $search) !== false ||
                stripos($book['author'], $search) !== false;
            return $matchCategory && $matchSearch;
        });

        $currentCategory = $categoryNames[$categoryId] ?? 'Books';
        return view('books', compact('books', 'categoryNames', 'currentCategory', 'categoryId'));
    })->name('books.category');
    Route::get('/category', function () {
        return view('category');
    });
    Route::get('/availability', function () {
        return view('availability');
    });
    Route::get('/Borrowed Books', function () {
        return view('Borrowed Books');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes (require admin authentication)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('admin.home');

    Route::get('/Home', function () {
        return view('home');
    });

    Route::get('/Student', function () {
        $students = \App\Models\Students::all();
        return view('student', compact('students'));
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

    // Student borrow book
    Route::post('/borrow', function (Request $request) {
        $book = \App\Models\Book::findOrFail($request->book_id);
        
        if ($book->status !== 'Available') {
            return back()->with('error', 'Book is not available for borrowing.');
        }

        \App\Models\Issue::create([
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'Borrowed',
        ]);

        $book->update(['status' => 'Borrowed']);

        return back()->with('success', 'Book borrowed successfully!');
    })->name('borrow.book');

    // Student return book
    Route::post('/return', function (Request $request) {
        $issue = \App\Models\Issue::where('book_id', $request->book_id)
                                   ->where('student_id', $request->student_id)
                                   ->where('status', 'Borrowed')
                                   ->firstOrFail();

        $issue->update([
            'return_date' => $request->return_date,
            'status' => 'Returned',
        ]);

        $book = \App\Models\Book::findOrFail($request->book_id);
        $book->update(['status' => 'Available']);

        return back()->with('success', 'Book returned successfully!');
    })->name('return.book');

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
