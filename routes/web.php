<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Students;


// kung i type pa ang dash board kini
// Route::get('/dashboard', function () {
//    return view('dashboard');
// });


// Route::get('/dashboard', [DashboardController::class, 'index']);


// kung gusto nimo direct dashboard kini gamita
 Route::get('/', [DashboardController::class, 'index']);
 Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/books', function () {
    return view('books');
});


Route::get('/category', function () {
    return view('category');
});


Route::get('/availability', function () {
    return view('availability');
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/books/{id}', function ($id) {
    return view('books', ['categoryId' => $id]);
});

Route::get('/Borrowed Books', function () {
    return view('Borrowed Books');
});

// admin
Route::get('/home', function () {
     return view('home');
});

Route::get('/Home', function () {
     return view('home');
});

Route::get('/Student', function () {
    $students = Students::all();

    return view('student', compact('students'));
});


Route::get('/Library', function () {
    return view('library', ['books' => session('books', [])]);
});

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

    return response()->json(['status' => 'added']);
});

Route::get('/library/delete/{id}', function ($id) {

    $books = session('books', []);

    unset($books[$id]);

    session(['books' => array_values($books)]);

    return response()->json(['status' => 'deleted']);
});