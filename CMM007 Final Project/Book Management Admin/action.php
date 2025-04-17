<?php

include("../DBConnect.php");

header("Content-Type: application/json");

try {
    if (!isset($_POST['action'])) {
        echo json_encode(['error' => "'action' key is missing in the request"]);
        exit;
    }

    // Handle the edit action
    if ($_POST['action'] === 'edit') {
        $data = array(
            ':title' => htmlspecialchars($_POST["title"]),
            ':author' => htmlspecialchars($_POST["author"]),
            ':isbn' => htmlspecialchars($_POST["isbn"]),
            ':genre' => htmlspecialchars($_POST["genre"]),
            ':quantity' => htmlspecialchars($_POST["quantity"]),
            ':description' => htmlspecialchars($_POST["description"]),
            ':bookID' => htmlspecialchars($_POST["bookID"])
        );

        $sql = "
        UPDATE books
        SET title = :title,
            author = :author,
            isbn = :isbn,
            genre = :genre,
            quantity = :quantity,
            description = :description
        WHERE bookID = :bookID
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        echo json_encode([
            'action' => $_POST['action'],
            'bookID' => $_POST['bookID']
        ]);
        exit;
    }

    if ($_POST['action'] !== 'delete') {
        echo json_encode(['success' => false, 'error' => "'action' key is missing or invalid"]);
        exit;
    }

    // Validate and sanitize the bookID
    $bookID = filter_input(INPUT_POST, 'bookID', FILTER_VALIDATE_INT);
    if (!$bookID) {
        echo json_encode(['success' => false, 'error' => 'Invalid book ID']);
        exit;
    }

    // Delete the book from the database
    $stmt = $db->prepare("DELETE FROM books WHERE bookID = :bookID");
    $stmt->execute([':bookID' => $bookID]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'bookID' => $bookID]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Book not found']);
    }
    exit;
} catch (PDOException $exception) {
    error_log("Error: " . $exception->getMessage(), 0);
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'An internal server error occurred']);
    exit;
}
?>