<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrow Request Rejected</title>
    <style>
        html, body { margin: 0; overflow: hidden; }
        body { font-family: Arial, sans-serif; color: #222; line-height: 1.35; font-size: 14px; }
        .message { max-width: none; margin: 0; padding: 6px 0; }
        p { margin: 4px 0; }
    </style>
</head>
<body>
    <div class="message">
        <p>Hello {{ $studentName }},</p>

        <p>Your borrow request was rejected.</p>

        <p><strong>Book Title:</strong> {{ $bookTitle }}</p>

        <p>You may submit a new request for another available book or contact the library staff for help.</p>

        <p>Thank you,<br>Cena Library</p>
    </div>
</body>
</html>
