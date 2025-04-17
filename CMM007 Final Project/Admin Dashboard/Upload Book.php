<?php

error_reporting(E_ALL);

require_once "../DBConnect.php";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    try {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $isbn = $_POST["isbn"];
        $description = $_POST["description"];
        $genre = $_POST["genre"];
        $quantity = $_POST["quantity"];

         // Validation: Check if all fields are filled
        if (empty($title) || empty($author) || empty($isbn) || empty($description) || empty($genre) || empty($quantity)) {
            throw new Exception("Please fill in all required fields.");
        }

        // Insert book details into the database
        $stmt = $db->prepare("INSERT INTO books (title, author, isbn, quantity, description, genre) 
        VALUES (:title, :author, :isbn, :quantity, :description, :genre)");
        $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':isbn' => $isbn,
            ':quantity' => $quantity,
            ':description' => $description,
            ':genre' => $genre
        ]);
        $bookID = $db->lastInsertId();

        // Validation: Check file type
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tempName = $_FILES["image"]["tmp_name"];
        $validExtensions = ["jpg", "jpeg", "png", "webp"];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validExtensions)) {
            throw new Exception("Unsupported file format. Allowed formats: " . implode(", ", $validExtensions));
        }

        // Validation: Check file size
        $maxFileSize = 5 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            throw new Exception("File size exceeds the 5MB limit.");
        }

        $newImageName = uniqid() . "." . $imageExtension;
        $uploadDir = __DIR__ . '/../Book_Covers/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            throw new Exception("Failed to create upload directory.");
        }

        if (!move_uploaded_file($tempName, $uploadDir . $newImageName)) {
            throw new Exception("Failed to upload the image.");
        }

        // Insert image details into the database
        $imageresult = $db->prepare("INSERT INTO bookcovers (bookID, imagePath) VALUES (:bookID, :imagePath)");
        $imageresult->execute([
            ':bookID' => $bookID,
            ':imagePath' => $newImageName
        ]);

        echo json_encode([
            'message' => 'Book has been uploaded successfully.',
            'redirect' => 'Admin Dashboard.php'
        ]);

    } catch (Exception $exception) {
        error_log($exception->getMessage(), 3, '../logs/errors.log');
        echo json_encode([
            'error' => $exception->getMessage()
        ]);
        exit();
    }
}
?>
