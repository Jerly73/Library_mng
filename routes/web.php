<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Post;


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