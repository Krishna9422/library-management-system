<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link rel="stylesheet" href="./style/return.css">
    <style>
        
header {
display: flex;
justify-content: space-between;
align-items: center;
padding: 10px 20px;
background-color: violet;
border-bottom: 1px solid #ddd;
}
.logo {
width: 60px; /* Adjust logo size as necessary */
/* height: auto; */
display: block; /* Ensures it behaves like a block element */
margin: 5px /* Centers the logo */

}
.logo img {
height: 50px; /* Adjust logo size as needed */
margin-right: 10px;
}

nav {
flex: 1;
display: flex;
justify-content: right;
}

nav ul.list {
display: flex;
list-style: none;
margin: 0;
padding: 0;
}

nav ul.list li {
margin: 0 15px;
}

nav ul.list li a {
text-decoration: none;
color: #333;
font-size: 18px;
font-weight: 600;
transition: color 0.3s;
}

nav ul.list li a:hover {
color: #007bff; /* Change color on hover */
}

/* Form Styles */
form {
    width: 100%;
    max-width: 400px;
    margin: 30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

form input[type="email"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box; /* Ensures padding does not affect the width */
}

form input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: violet;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #5f3db5;
}

/* Error message styles */
p.error {
    color: red;
    font-size: 14px;
    text-align: center;
}

/* Sign-up link */
p {
    text-align: center;
    margin-top: 15px;
}

p a {
    color: violet;
    font-weight: bold;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}
.list {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .list li {
        position: relative;
    }

    .list li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        padding: 8px 16px;
        display: block;
    }

    .list li a:hover {
        background-color: #fc25f8;
        border-radius: 5px;
    }
      .dropdown:hover.dropdown-menu {
        display: block;
    }

    .dropdown-menu {

        position: absolute;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        list-style: none;
        padding: 10px 0;
        min-width: 150px;
        top: 100%; /* Positions dropdown below the parent menu */
        left: 0;
    }

    .dropdown-menu li a {
        color: #333;
        padding: 10px 16px;
    }

    .dropdown-menu li a:hover {
        background-color: #f0f0f0;
        color: #6a11cb;
        border-radius: 5px;
    }
    .dropdown {
    position: relative; /* Ensure dropdown is positioned relative to its parent */
}

.dropdown:hover .dropdown-menu {
    display: block; /* Show dropdown on hover */
}

.dropdown-menu {
    display: none; /* Hide dropdown by default */
    position: absolute;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    list-style: none;
    padding: 10px 0;
    min-width: 150px;
    top: 100%; /* Positions dropdown below the parent menu */
    left: 0;
}

.dropdown-menu li a {
    color: #333;
    padding: 10px 16px;
    text-decoration: none; /* Remove underline from links */
}

.dropdown-menu li a:hover {
    background-color: #f0f0f0;
    color: #6a11cb;
    border-radius: 5px;
}
    </style>
    <script>
        function fetchReferralCodes(borrowerId) {
            // Create an AJAX request to get referral codes based on the selected borrower_id
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // AJAX request to the same file
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Populate the referral_code dropdown with options
                    document.getElementById("referral_code").innerHTML = xhr.responseText;
                }
            };
            xhr.send("action=fetch_referral_codes&borrower_id=" + borrowerId);
        }
    </script>
</head>
<body>
<header>  
<img src="https://www.mgmmcha.org/images/logos/mgmlogo.png" alt="College Logo" class="logo">
        <nav>
            <ul class="list">
                <li><a href="http://localhost/library_final/home.php">Home</a></li>
                <li><a href="http://localhost/library_final/books.php">Books</a></li>
                <li><a href="http://localhost/library_final/add-book.php">Add New Book</a></li>
                <li><a href="http://localhost/library_final/return-book.php">Return  Books</a></li>
                <li><a href="http://localhost/library_final/loan_book.php">Loan Book</a></li>
               
                <li><a href="http://localhost/library_final/borrowers.php">Student Id</a></li>
              
               
               
                <li class="dropdown">
                <a href="#"><b>Loan menu</b></a>
                <ul class="dropdown-menu">
                <li><a href="http://localhost/library_final/fine.php">fine</a></li>
                <li><a href="http://localhost/library_final/borrowers1.php">Borrower </a></li>
                <li><a href="http://localhost/library_final/loan.php">Loaned Book</a></li>
                <li><a href="http://localhost/library_final/overduebook.php">overdue books</a></li>   
                </ul>
            </li>
            </ul>
        </nav>
</header>

<h1>Return Book</h1>

<?php
// Database connection
include 'db.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// AJAX request handler for fetching referral codes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'fetch_referral_codes') {
    $borrower_id = $_POST['borrower_id'];
    $stmt = $conn->prepare("SELECT DISTINCT referral_code FROM loans WHERE borrower_id = ?");
    $stmt->bind_param("i", $borrower_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate options for the referral_code dropdown
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['referral_code'] . "'>" . $row['referral_code'] . "</option>";
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Form submission handler for processing the return
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    $borrower_id = $_POST['borrower_id'];
    $referral_code = $_POST['referral_code'];
    $return_date = $_POST['return_date'];

    // Find the loan entry based on borrower_id and referral_code
    $sql = "SELECT l.*, b.isbn, b.book_id 
            FROM loans l 
            JOIN books b ON l.book_id = b.book_id 
            WHERE l.borrower_id = ? 
            AND l.referral_code = ? 
            LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $borrower_id, $referral_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $loan = $result->fetch_assoc();
        $isbn = $loan['isbn'];
        $book_id = $loan['book_id'];

        // Insert into `return` table
        $sql_insert = "INSERT INTO `returns` (borrower_id, isbn, referral_code, return_date) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("isss", $borrower_id, $isbn, $referral_code, $return_date);
        $stmt_insert->execute();

        // Delete from loans table
        $sql_delete = "DELETE FROM loans WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $loan['id']);
        $stmt_delete->execute();

        // Update books table (decrement loaned_copies, increment available_copies)
        $sql_update = "UPDATE books 
                       SET loaned_copies = loaned_copies - 1, available_copies = available_copies + 1 
                       WHERE book_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $book_id);
        $stmt_update->execute();

        echo "<p>Book returned successfully!</p>";
    } else {
        echo "<p>No matching loan found for the provided details.</p>";
    }
}
?>

<!-- Return Book Form -->
<form action="http://localhost/library_final/process_return.php" method="POST">
    <label for="borrower_id">Borrower ID:</label>
    <select id="borrower_id" name="borrower_id" required onchange="fetchReferralCodes(this.value)">
        <option value="">Select Borrower</option>
        <?php
        // Fetch unique borrower_ids from the loans table
        $result = $conn->query("SELECT DISTINCT borrower_id FROM loans");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['borrower_id'] . "'>" . $row['borrower_id'] . "</option>";
        }
        ?>
    </select><br>

    <label for="referral_code">Referral Code:</label>
    <select id="referral_code" name="referral_code" required>
        <option value="">Select Referral Code</option>
    </select><br>

    <label for="return_date">Return Date:</label>
    <input type="date" id="return_date" name="return_date" required><br>

    <input type="submit" value="Return Book">
</form>

<?php $conn->close(); ?>
</body>
</html>
