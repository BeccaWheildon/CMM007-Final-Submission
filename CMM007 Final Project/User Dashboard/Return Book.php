<?php

error_reporting(E_ALL);
require_once "../DBConnect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
        http_response_code(400);
        echo "<script>
            alert('Session expired or user not logged in.');
            window.location.href = 'Login.php';
        </script>";
        exit();
    }

    $book_id = filter_input(INPUT_POST, 'bookID', FILTER_SANITIZE_NUMBER_INT); // Sanitize input
    $db->beginTransaction();
    try {
        // UPDATE currentBorrowedBooks
        $stmt = $db->prepare("UPDATE userdetails SET currentBorrowedBooks = currentBorrowedBooks - 1 WHERE userID = :userID");
        $stmt->bindValue(':userID', $_SESSION['userID'], PDO::PARAM_INT);
        if (!$stmt->execute()) {
            throw new PDOException("Failed to update currentBorrowedBooks. " . implode(", ", $stmt->errorInfo()));
        }

        // DELETE bookreservation entry
        $stmt = $db->prepare("DELETE FROM bookreservation WHERE bookID = :bookID");
        $stmt->bindValue(':bookID', $book_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            throw new PDOException("Failed to delete bookreservation. " . implode(", ", $stmt->errorInfo()));
        }

        // UPDATE books quantity
        $stmt = $db->prepare("UPDATE books SET quantity = quantity + 1 WHERE bookID = :bookID");
        $stmt->bindValue(':bookID', $book_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            throw new PDOException("Failed to update books quantity. " . implode(", ", $stmt->errorInfo()));
        }

        $db->commit();
        echo "<script>
            alert('Book has been successfully returned.');
            window.location.href = 'User Dashboard.php';
        </script>";
    } catch (PDOException $exception) {
        $db->rollBack();
        error_log("Transaction Error: " . $exception->getMessage());
        echo "<script>
            alert('An error occurred while processing your request. Please try again later.');
            window.history.back();
        </script>";
    } finally {
        unset($db);
    }
} else {
    http_response_code(400);
    echo "<script>
        alert('Invalid request. Please try again.');
        window.history.back();
    </script>";
}

?>