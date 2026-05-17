<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Returned Successfully</title>
    <style>
        html, body { margin: 0; overflow: hidden; }
        body { font-family: Arial, sans-serif; color: #222; line-height: 1.35; font-size: 14.5px; }
        .message { max-width: none; margin: 0; padding: 6px 0; }
        p { margin: 4px 0; }
        .details { margin: 8px 10px; }
        .details p { margin: 2px 10px; }
    </style>
</head>
<body>
    <div class="message">
        <p>Hello {{ $studentName }},</p>

        <p>The book you borrowed has been successfully returned.</p>

        <div class="details">
            <p><strong>Book Title:</strong> {{ $bookTitle }}</p>
            <p><strong>Book ID:</strong> {{ $bookId }}</p>
            <p><strong>Student ID:</strong> {{ $studentId }}</p>
            <p><strong>Borrow Date &amp; Time:</strong> {{ \Carbon\CarbonImmutable::parse($borrowDate)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') }}</p>
            <p><strong>Return Date &amp; Time:</strong> {{ \Carbon\CarbonImmutable::parse($returnDate)->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') }}</p>
        </div>

        <p>Thank you for returning the book.</p>

        <p>Thank you,<br>Cena Library</p>
    </div>
</body>
</html>
