<?php
include 'db.php';

// Fetch borrowers from the database
$borrowerQuery = "SELECT id, borrower_name FROM borrowers";
$borrowerResult = $conn->query($borrowerQuery);

// Fetch unique book titles
$titleQuery = "SELECT DISTINCT title FROM book_copies";
$titleResult = $conn->query($titleQuery);

// Fetch referral codes that are not used in the loan table
$referralQuery = "
    SELECT title, referral_code, isbn
    FROM book_copies bc
    WHERE NOT EXISTS (
        SELECT 1 FROM loans l WHERE l.referral_code = bc.referral_code
    )
";
$referralResult = $conn->query($referralQuery);

// Prepare referral code and ISBN data for JavaScript
$referralCodesByTitle = [];
while ($row = $referralResult->fetch_assoc()) {
    $referralCodesByTitle[$row['title']][] = [
        'referral_code' => $row['referral_code'],
        'isbn' => $row['isbn']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Book</title>
    <link rel="stylesheet" href="./style/loan.css">
    <style> 
      nav {
        background-color: violet;
        padding: 10px;
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
}</style>
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

<h1>Loan Book</h1>

<main>
<form action="http://localhost/library_final/process-loan.php" method="POST">
    <label for="borrower_id">Select Borrower:</label>
    <select name="borrower_id" id="borrower_id" required>
        <option value="">Select Borrower</option>
        <?php while ($borrower = $borrowerResult->fetch_assoc()): ?>
            <option value="<?php echo $borrower['id']; ?>">
                <?php echo $borrower['id'] . " - " . htmlspecialchars($borrower['borrower_name']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="title">Select Book Title:</label>
    <select name="title" id="title" required onchange="updateReferralCodes()">
        <option value="">Select Title</option>
        <?php while ($title = $titleResult->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($title['title']); ?>">
                <?php echo htmlspecialchars($title['title']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="referral_code">Select Book (Referral Code):</label>
    <select name="referral_code" id="referral_code" required onchange="updateIsbn()">
        <option value="">Select Referral Code</option>
    </select>

    <label for="isbn">ISBN:</label>
    <input type="text" name="isbn" id="isbn" readonly>

    <label for="borrow_date">Borrow Date:</label>
    <input type="date" name="borrow_date" id="borrow_date" required>

    <input type="submit" value="Loan Book">
</form>
</main>

<script>
// Data structure to store referral codes and ISBNs grouped by title
const referralCodesByTitle = <?php echo json_encode($referralCodesByTitle); ?>;

// Function to update referral codes based on selected title
function updateReferralCodes() {
    const titleSelect = document.getElementById("title");
    const referralCodeSelect = document.getElementById("referral_code");
    const isbnInput = document.getElementById("isbn");
    const selectedTitle = titleSelect.value;

    // Clear previous options and ISBN
    referralCodeSelect.innerHTML = '<option value="">Select Referral Code</option>';
    isbnInput.value = '';

    // Populate referral codes and set ISBN for selected title
    if (selectedTitle in referralCodesByTitle) {
        referralCodesByTitle[selectedTitle].forEach(item => {
            const option = document.createElement("option");
            option.value = item.referral_code;
            option.textContent = item.referral_code;
            option.dataset.isbn = item.isbn;  // Store ISBN in data attribute
            referralCodeSelect.appendChild(option);
        });
    }
}

// Function to update ISBN based on selected referral code
function updateIsbn() {
    const referralCodeSelect = document.getElementById("referral_code");
    const isbnInput = document.getElementById("isbn");
    const selectedOption = referralCodeSelect.options[referralCodeSelect.selectedIndex];

    // Update ISBN input field with selected referral code's ISBN
    if (selectedOption && selectedOption.dataset.isbn) {
        isbnInput.value = selectedOption.dataset.isbn;
    } else {
        isbnInput.value = '';
    }
}
</script>
<?php
if (isset($_GET['message'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['message']) . "');</script>";
}
?>
</body>
</html>
