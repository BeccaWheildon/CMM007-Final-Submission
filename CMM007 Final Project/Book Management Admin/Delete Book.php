<?php
require_once "../DBConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $bookID = filter_input(INPUT_POST, 'bookID', FILTER_VALIDATE_INT);

    if ($action === 'delete' && $bookID) {
        try {
            $stmt = $db->prepare("DELETE FROM books WHERE bookID = ?");
            $stmt->execute([$bookID]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Book not found.']);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0);
            echo json_encode(['success' => false, 'error' => 'Database error.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request: action key or bookID missing.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
