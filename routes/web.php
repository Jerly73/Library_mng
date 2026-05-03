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
        return view('books');
    })->name('books');
    Route::get('/books/{id}', function ($id) {
        return view('books', ['categoryId' => $id]);
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
        return view('library', ['books' => session('books', [])]);
    })->name('admin.library');

    Route::post('/library/add', function (Request $request) {
        $books = session('books', []);
        $books[] = [
            'name' => $request->name,
            'writer' => $request->writer,
            'id' => $request->book_id,
            'subject' => $request->subject,
            'class' => $request->class,
            'date' => $request->date,
        ];
        session(['books' => $books]);
        return redirect()->back();
    })->name('admin.library.add');

    Route::delete('/library/delete/{id}', function ($id) {
        $books = session('books', []);
        unset($books[$id]);
        session(['books' => array_values($books)]);
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
