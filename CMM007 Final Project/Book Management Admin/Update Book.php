<?php
require_once "../DBConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = filter_input(INPUT_POST, 'bookID', FILTER_VALIDATE_INT);
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $isbn = $_POST['isbn'] ?? null;
    $genre = $_POST['genre'] ?? null;
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $description = $_POST['description'] ?? null;

    // Validation: Check for required fields
    if (!$book_id || !$title || !$author || !$isbn || !$genre || !$quantity || !$description) {
        die("Invalid form submission.");
    }

    // Validation: Check ISBN format
    if (!preg_match('/^\d{10}$|^\d{13}$/', $isbn)) {
        die("Invalid ISBN. It must be 10 or 13 digits.");
    }

    // Validation: Check file type and size for book cover
    if (isset($_FILES['bookCover'])) {
        $bookCover = $_FILES['bookCover'];
        $allowedFileTypes = ["image/jpeg", "image/png", "image/gif"];
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

        if (!in_array($bookCover['type'], $allowedFileTypes)) {
            die("Invalid file type. Only JPG, PNG, or GIF files are allowed.");
        }

        if ($bookCover['size'] > $maxFileSize) {
            die("File size exceeds the 5MB limit.");
        }

        // Additional logic to handle file upload (optional)
        $uploadDir = '../Book_Covers/';
        $uploadPath = $uploadDir . basename($bookCover['name']);
        if (!move_uploaded_file($bookCover['tmp_name'], $uploadPath)) {
            die("Failed to upload book cover.");
        }
    }

    // Update book in the database
    $sql = "UPDATE books SET title = ?, author = ?, isbn = ?, genre = ?, quantity = ?, description = ? WHERE bookID = ?";
    $stmt = $db->prepare($sql);

    if ($stmt->execute([$title, $author, $isbn, $genre, $quantity, $description, $book_id])) {
        echo "<script>
            alert('Record updated');
            window.location.href='Manage Book Catalogue.php';
          </script>";
    exit();
} else {
    die("Failed to update book.");
}
    
}
?>
