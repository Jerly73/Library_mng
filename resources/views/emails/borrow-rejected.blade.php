<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrow Request Rejected</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #dc2626; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 30px; background-color: #f9f9f9; border: 1px solid #ddd; border-top: none; }
        .details { margin: 20px 0; }
        .details table { width: 100%; border-collapse: collapse; }
        .details td { padding: 10px; border-bottom: 1px solid #ddd; }
        .details td:first-child { font-weight: bold; width: 40%; }
        .footer { text-align: center; padding: 20px; background-color: #f1f1f1; font-size: 12px; border-radius: 0 0 5px 5px; }
        .status { display: inline-block; padding: 5px 15px; background-color: #ef4444; color: white; border-radius: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Borrow Request Rejected</h1>
        </div>

        <div class="content">
            <p>Dear {{ $studentName }},</p>

            <p>We regret to inform you that your borrow request for the following book has been <strong style="color: #dc2626;">REJECTED</strong> by the library administrator:</p>

            <div class="details">
                <table>
                    <tr>
                        <td>Book Title</td>
                        <td>{{ $bookTitle }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><span class="status">Rejected</span></td>
                    </tr>
                </table>
            </div>

            <p><strong>Possible reasons for rejection:</strong></p>
            <ul>
                <li>The book is no longer available</li>
                <li>Issues with your library account</li>
                <li>Maximum borrowing limit reached</li>
            </ul>

            <p>You may submit a new reservation for a different book or contact the library staff for clarification.</p>

            <p>Best regards,<br>Cena Library Management System</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Cena Library. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
