<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'student_id',
        'book_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
