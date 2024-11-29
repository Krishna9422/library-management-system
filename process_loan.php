<?php
include 'db.php';

// Get form data
$borrower_id = $_POST['borrower_id'];
$book_id = $_POST['book_id'];
$borrow_date = $_POST['borrow_date'];
$referral_code = $_POST['referral_code'];

// Insert loan record with referral code
$insertLoan = "INSERT INTO loan (borrower_id, book_id, borrow_date, referral_code) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insertLoan);
$stmt->bind_param("iiss", $borrower_id, $book_id, $borrow_date, $referral_code);
$stmt->execute();
$stmt->close();

// Increment loaned_copies in books table
$updateBooks = "UPDATE books SET loaned_copies = loaned_copies + 1 WHERE book_id = ?";
$stmt = $conn->prepare($updateBooks);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$stmt->close();

echo "Book loan recorded successfully!";
$conn->close();
?>
