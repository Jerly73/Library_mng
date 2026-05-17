<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use App\Mail\BookDueDateNotice;
use App\Models\Issue;
use App\Models\Message;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('library:send-due-notices', function () {
    $dueIssues = Issue::with('book', 'student')
        ->whereIn('status', ['Approved', 'Borrowed'])
        ->whereDate('due_date', '<=', now()->toDateString())
        ->whereNull('due_notice_sent_at')
        ->get();

    foreach ($dueIssues as $issue) {
        Message::firstOrCreate(
            [
                'user_id' => $issue->student_id,
                'issue_id' => $issue->id,
                'type' => 'due_date',
            ],
            [
                'title' => 'Book Due Date Notice',
                'body' => "The book you borrowed is on due date.\n\nBook Title: {$issue->book->title}\nBook ID: " . ($issue->book->book_id ?? $issue->book->id) . "\nStudent ID: {$issue->student_id}\nBorrow Date & Time: " . \Carbon\CarbonImmutable::parse($issue->borrow_date)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') . "\nDue Date: " . \Carbon\CarbonImmutable::parse($issue->due_date)->setTimezone(config('app.timezone'))->format('M d, Y'),
            ]
        );

        if (!$issue->student || !$issue->student->email) {
            $issue->update(['due_notice_sent_at' => now()]);
            continue;
        }

        Mail::to($issue->student->email)->send(new BookDueDateNotice(
            $issue->book->title,
            $issue->book->book_id ?? $issue->book->id,
            $issue->student_id,
            $issue->student->name,
            $issue->borrow_date,
            $issue->due_date
        ));

        $issue->update(['due_notice_sent_at' => now()]);
        $this->info("Sent due date notice for issue #{$issue->id}.");
    }

    $this->info('Due date notice check complete.');
})->purpose('Send due date notices for borrowed books whose due date has arrived');

Schedule::command('library:send-due-notices')->dailyAt('08:00');
