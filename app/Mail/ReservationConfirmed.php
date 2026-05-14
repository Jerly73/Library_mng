<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed extends Mailable
{
    use Queueable;

    public $bookTitle;
    public $bookId;
    public $studentName;
    public $studentId;
    public $borrowDate;
    public $dueDate;

    /**
     * Create a new message instance.
     */
    public function __construct($bookTitle, $bookId, $studentName, $studentId, $borrowDate, $dueDate)
    {
        $this->bookTitle = $bookTitle;
        $this->bookId = $bookId;
        $this->studentName = $studentName;
        $this->studentId = $studentId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Library Reservation Confirmed - ' . $this->bookTitle,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
