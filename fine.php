<?php
session_start();
include 'db.php'; // Database connection

// Current date
$current_date = date('Y-m-d');

// Query to fetch overdue loans with fine calculation and borrower names
$sql = "
    SELECT 
        l.borrower_id, 
        br.borrower_name,
        b.title AS book_title, 
        l.referral_code, 
        l.due_date,
        DATEDIFF('$current_date', l.due_date) AS overdue_days -- Calculate overdue days
    FROM loans l
    INNER JOIN books b ON l.book_id = b.book_id
    INNER JOIN borrowers br ON l.borrower_id = br.id
    WHERE l.due_date < '$current_date'
";

$result = $conn->query($sql);

$borrowerFines = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $borrower_id = $row['borrower_id'];
        $borrower_name = $row['borrower_name'];
        $book_info = [
            'book_title' => $row['book_title'],
            'referral_code' => $row['referral_code'],
            'due_date' => $row['due_date'],
            'fine' => $row['overdue_days'] * 2 // Fine: ₹2 per day
        ];

        // Group books by borrower_id
        if (!isset($borrowerFines[$borrower_id])) {
            $borrowerFines[$borrower_id] = [
                'borrower_name' => $borrower_name,
                'total_fine' => 0,
                'books' => []
            ];
        }

        $borrowerFines[$borrower_id]['total_fine'] += $book_info['fine'];
        $borrowerFines[$borrower_id]['books'][] = $book_info;
    }
}

// Encode borrower fines into JSON for JavaScript
$borrowerFinesJson = json_encode($borrowerFines);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Books and Fines</title>
    <link rel="stylesheet" href="./style/books..css">
    <style>
        h2 {
            text-align: center;
            color: #4A4A4A;
            font-size: 24px;
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: violet;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .no-overdue {
            text-align: center;
            font-size: 18px;
            color: green;
        }
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
        top: 100%; 
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
    position: relative; 
}

.dropdown:hover .dropdown-menu {
    display: block; 
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    list-style: none;
    padding: 10px 0;
    min-width: 150px;
    top: 100%;
    left: 0;
}

.dropdown-menu li a {
    color: #333;
    padding: 10px 16px;
    text-decoration: none; 
}

.dropdown-menu li a:hover {
    background-color: #f0f0f0;
    color: #6a11cb;
    border-radius: 5px;
}
    </style>
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

<h2>Overdue Books and Fines</h2>

<?php if (count($borrowerFines) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Borrower ID</th>
                <th>Borrower Name</th>
                <th>Books Overdue (Details)</th>
                <th>Total Fine (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowerFines as $borrower_id => $details): ?>
                <tr>
                    <td><?php echo htmlspecialchars($borrower_id); ?></td>
                    <td><?php echo htmlspecialchars($details['borrower_name']); ?></td>
                    <td>
                        <ul>
                            <?php foreach ($details['books'] as $book): ?>
                                <li>
                                    <strong>Title:</strong> <?php echo htmlspecialchars($book['book_title']); ?>, 
                                    <strong>Referral Code:</strong> <?php echo htmlspecialchars($book['referral_code']); ?>, 
                                    <strong>Due Date:</strong> <?php echo htmlspecialchars($book['due_date']); ?>, 
                                    <strong>Fine:</strong> ₹<?php echo htmlspecialchars($book['fine']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>₹<?php echo htmlspecialchars($details['total_fine']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="no-overdue">No overdue books at this time.</div>
<?php endif; ?>

</body>
</html>
