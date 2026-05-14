<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservation Confirmed</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #6A2727; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 30px; background-color: #f9f9f9; border: 1px solid #ddd; border-top: none; }
        .details { margin: 20px 0; }
        .details table { width: 100%; border-collapse: collapse; }
        .details td { padding: 10px; border-bottom: 1px solid #ddd; }
        .details td:first-child { font-weight: bold; width: 40%; }
        .footer { text-align: center; padding: 20px; background-color: #f1f1f1; font-size: 12px; border-radius: 0 0 5px 5px; }
        .status { display: inline-block; padding: 5px 15px; background-color: #fbbf24; color: #92400e; border-radius: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reservation Confirmed</h1>
        </div>

        <div class="content">
            <p>Dear {{ $studentName }},</p>

            <p>Your book reservation has been successfully submitted and is now <strong>pending admin approval</strong>.</p>

            <div class="details">
                <table>
                    <tr>
                        <td>Book Title</td>
                        <td>{{ $bookTitle }}</td>
                    </tr>
                    <tr>
                        <td>Book ID</td>
                        <td>{{ $bookId }}</td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td>{{ $studentName }}</td>
                    </tr>
                    <tr>
                        <td>Student ID</td>
                        <td>{{ $studentId }}</td>
                    </tr>
                    <tr>
                        <td>Reservation Date</td>
                        <td>{{ $borrowDate }}</td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>{{ $dueDate }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><span class="status">Pending Approval</span></td>
                    </tr>
                </table>
            </div>

            <p><strong>Next Steps:</strong></p>
            <ol>
                <li>Your request is now under review by the library administrator.</li>
                <li>Once approved, the book status will change to "Borrowed".</li>
                <li>You will receive an email notification when your request is approved.</li>
                <li>Please return the book on or before the due date.</li>
            </ol>

            <p>If you have any questions, please contact the library staff.</p>

            <p>Best regards,<br>Cena Library Management System</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Cena Library. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
