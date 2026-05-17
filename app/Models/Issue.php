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
        'due_notice_sent_at',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'due_date' => 'date',
        'return_date' => 'datetime',
        'due_notice_sent_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }
}
