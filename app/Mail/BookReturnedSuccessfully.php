<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BookReturnedSuccessfully extends Mailable
{
    use Queueable;

    public $bookTitle;
    public $bookId;
    public $studentId;
    public $studentName;
    public $borrowDate;
    public $returnDate;

    public function __construct($bookTitle, $bookId, $studentId, $studentName, $borrowDate, $returnDate)
    {
        $this->bookTitle = $bookTitle;
        $this->bookId = $bookId;
        $this->studentId = $studentId;
        $this->studentName = $studentName;
        $this->borrowDate = $borrowDate;
        $this->returnDate = $returnDate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Book Returned Successfully - ' . $this->bookTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.book-returned-successfully',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
