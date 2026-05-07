<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'writer',
        'book_id',
        'subject',
        'class',
        'date',
        'title',
        'author',
        'category_id',
        'cover',
        'description',
        'status',
    ];
}
