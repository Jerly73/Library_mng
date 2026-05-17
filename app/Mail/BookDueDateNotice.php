<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BookDueDateNotice extends Mailable
{
    use Queueable;

    public $bookTitle;
    public $bookId;
    public $studentId;
    public $studentName;
    public $borrowDate;
    public $dueDate;

    public function __construct($bookTitle, $bookId, $studentId, $studentName, $borrowDate, $dueDate)
    {
        $this->bookTitle = $bookTitle;
        $this->bookId = $bookId;
        $this->studentId = $studentId;
        $this->studentName = $studentName;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Book Due Date Notice - ' . $this->bookTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.book-due-date-notice',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
