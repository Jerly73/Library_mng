<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller

{
    public function index()
    {
        $books = \App\Models\Book::all();
        return view('dashboard', compact('books'));
    }
}
