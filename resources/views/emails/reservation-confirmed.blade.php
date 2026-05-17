<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservation Confirmed</title>
    <style>
        html, body { margin: 0; overflow: hidden; }
        body { font-family: Arial, sans-serif; color: #222; line-height: 1.35; font-size: 14px; }
        .message { max-width: none; margin: 0; padding: 6px 0; }
        p { margin: 4px 0; }
        .details { margin: 8px 0; }
        .details p { margin: 2px 0; }
    </style>
</head>
<body>
    <div class="message">
        <p>Hello {{ $studentName }},</p>

        <p>Your book reservation was submitted and is waiting for admin approval.</p>

        <div class="details">
            <p><strong>Book Title:</strong> {{ $bookTitle }}</p>
            <p><strong>Book ID:</strong> {{ $bookId }}</p>
            <p><strong>Student ID:</strong> {{ $studentId }}</p>
            <p><strong>Reservation Date:</strong> {{ $borrowDate }}</p>
            <p><strong>Due Date:</strong> {{ $dueDate }}</p>
        </div>

        <p>You will receive another message once the admin approves or rejects your request.</p>

        <p>Thank you,<br>Cena Library</p>
    </div>
</body>
</html>
