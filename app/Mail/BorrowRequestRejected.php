<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowRequestRejected extends Mailable
{
    use Queueable;

    public $bookTitle;
    public $studentName;

    public function __construct($bookTitle, $studentName)
    {
        $this->bookTitle = $bookTitle;
        $this->studentName = $studentName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Borrow Request Rejected - ' . $this->bookTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.borrow-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
