<?php
session_start();

error_reporting(E_ALL);
require_once "../DBConnect.php";

// GET THE BOOK ID FROM URL AND DISPLAY CORRECT INFORMATION
$book_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$book_id || $book_id <= 0) {
    die("Invalid book ID.");
}

$sql = "SELECT books.*, bookcovers.imagePath 
        FROM books
        LEFT JOIN bookcovers ON books.bookID = bookcovers.bookID
        WHERE books.bookID = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Item not found.");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Dunblane Library</title>
    <link rel="stylesheet" href="../Bootstrap.css">
    <link rel="stylesheet" href="../Website Styling.css">
</head>

<body>

    <!-- NAVIGATION BAR -->
    <?php include '../Navbar.php'; ?>

    <!-- BOOK DETAILS -->
    <main class="container">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="../Book_Covers/<?php echo $book['imagePath']; ?>" class="d-flex justify-content-center align-items-center" id="book_image" alt="<?php echo $book['title']; ?> book cover" style="width: 300px;">
            </div>
            <div class="col-md-6" style="background-color: white;">
                <h2><?php echo $book['title']; ?></h2></br>
                <p>Author - <?php echo $book['author']; ?></p>
                <p>ISBN - <?php echo $book['isbn']; ?></p>
                <p>Quantity - <?php echo $book['quantity']; ?></p>
                <p>Genre - <?php echo $book['genre']; ?></p>
                <p>Description - <?php echo $book['description']; ?></p>

                <div>
                    <button class="btn btn-primary moreInfo" onclick="borrowBook(<?php echo $book['bookID']; ?>)">Borrow Book</button>
                </div>


            </div>

        </div>
    </main>
    <script>
        // FUNCTION FOR BORROWING A BOOK
        function borrowBook(bookID) {
            if (confirm("Are you sure you want to borrow this book?")) {
                let form = document.createElement("form");
                form.method = "POST";
                form.action = `Borrow Book.php?id=${bookID}`;
                console.log(`Form action: ${form.action}`);
                document.body.appendChild(form);
                form.submit();
            }
    }
</script>
<!-- FOOTER -->
<footer class="bg-secondary text-center fw-bold py-3 text-white">
    <p>
        Address: 122 High St, Dunblane FK15 0ER<br>
        Phone: 01786 823125<br><br>
        &copy; Stirling Council 2025 - 2028. All rights reserved
        
    </p>
</footer>
        <script src="Book Search.js"></script>
    </main>
</html>