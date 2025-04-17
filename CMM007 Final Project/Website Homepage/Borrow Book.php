<?php

error_reporting(E_ALL);
session_start();

if (!isset($_SESSION["userID"]) || !filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../Login Page/Login Page.html");
    exit();
}

$book_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$book_id || $book_id <= 0) {
    header("Location: ../Error Pages/Error.php?message=Invalid+book+ID");
    exit();
}

require_once "../DBConnect.php";
require_once "../Session Info.php";

$sql = "SELECT * FROM books WHERE bookID = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "<script>alert('Book not found. Please try again.');</script>";
    exit();
}

if ($book['quantity'] < 1) {
    echo "<script>alert('This book is currently unavailable.');</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->beginTransaction();
    try {
        $sql = "SELECT currentBorrowedBooks, maxBorrowedBooks FROM userdetails WHERE userID = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION['userID']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!isset($user["currentBorrowedBooks"], $user["maxBorrowedBooks"]) || 
            !is_numeric($user["currentBorrowedBooks"]) || 
            !is_numeric($user["maxBorrowedBooks"])) {
            throw new Exception("User borrow limit data is invalid or corrupted.");
        }

        $email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new Exception("Invalid user email.");
        }

        // LIMITS NUMBER OF BOOKS USER CAN BORROW AT ONE TIME
        if ($user["currentBorrowedBooks"] >= $user["maxBorrowedBooks"]) {
            echo "<script>
            alert('The maximum number of books you can borrow at one time is 5. Please return a book before borrowing.');
            window.location.href = 'homepage.php';
            </script>";
            $db->rollBack();
            exit();
        }

        //CREATE NEW ENTRY IN BOOK RESERVATIONS TABLE
        $sql = "INSERT INTO bookreservation (bookID, reservationEmail, reservationDate) VALUES (?, ?, NOW())";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute([$book_id, $email])) {
            throw new Exception("Failed to insert book reservation.");
        }

        //UPDATE QUANTITY IN BOOKS TABLE
        $sql = "UPDATE books 
                SET quantity = quantity - 1 
                WHERE bookID = ? AND quantity > 0";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute([$book_id])) {
            throw new Exception("Failed to update book quantity.");
        }

        //UPDATE USER DETAILS TABLE
        $sql = "UPDATE userdetails 
                SET currentBorrowedBooks = currentBorrowedBooks + 1 
                WHERE userID = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute([$_SESSION['userID']])) {
            throw new Exception("Failed to update user borrowed books count.");
        }

        $db->commit();
        echo "<script>
        alert('Reservation has been successfully made.');
        window.location.href = 'homepage.php';
        </script>";
        exit();
    } catch (Exception $e) {
        $db->rollBack();
        error_log($e->getMessage(), 3, "../error_log.txt");
        echo "<script>
        alert('An error occurred while processing your request. Please try again later.');
        window.location.href = 'homepage.php';
        </script>";
        exit();
    }
}
?>
