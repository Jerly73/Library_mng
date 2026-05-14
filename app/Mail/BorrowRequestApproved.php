<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowRequestApproved extends Mailable
{
    use Queueable;

    public $bookTitle;
    public $bookId;
    public $studentName;
    public $borrowDate;
    public $dueDate;

    public function __construct($bookTitle, $bookId, $studentName, $borrowDate, $dueDate)
    {
        $this->bookTitle = $bookTitle;
        $this->bookId = $bookId;
        $this->studentName = $studentName;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Borrow Request Approved - ' . $this->bookTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.borrow-approved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
