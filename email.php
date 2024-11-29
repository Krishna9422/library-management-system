<?php
include 'db.php';

// Fetch borrowers with overdue books
$sql = "
    SELECT 
        borrowers.borrower_name, 
        borrowers.borrower_email, 
        books.title, 
        loans.borrow_date,
        DATE_ADD(loans.borrow_date, INTERVAL 15 DAY) AS due_date,
        DATEDIFF(CURDATE(), DATE_ADD(loans.borrow_date, INTERVAL 15 DAY)) AS overdue_days
    FROM 
        loans
    JOIN 
        books ON loans.book_id = books.book_id
    JOIN 
        borrowers ON loans.borrower_id = borrowers.id
    WHERE 
        loans.return_date IS NULL
        AND DATEDIFF(CURDATE(), DATE_ADD(loans.borrow_date, INTERVAL 15 DAY)) > 0
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $borrower_name = $row['borrower_name'];
        $borrower_email = $row['borrower_email'];
        $book_title = $row['title'];
        $due_date = $row['due_date'];
        $overdue_days = $row['overdue_days'];
        $fine = $overdue_days * 2; // ₹2 per overdue day

        // Email content
        $subject = "Overdue Book Notification";
        $message = "
        Dear $borrower_name,

        This is a reminder that the book '$book_title' is overdue.

        Due Date: $due_date
        Overdue Days: $overdue_days
        Fine Amount: ₹$fine

        Please return the book as soon as possible to avoid further fines.

        Thank you,
        Library Management
        ";
        $headers = "From: library@yourdomain.com\r\n";
        $headers .= "Reply-To: library@yourdomain.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send the email
        if (mail($borrower_email, $subject, $message, $headers)) {
            echo "Email sent successfully to $borrower_email<br>";
        } else {
            echo "Failed to send email to $borrower_email<br>";
        }
    }
} else {
    echo "No overdue books found.";
}

$conn->close();
?>
