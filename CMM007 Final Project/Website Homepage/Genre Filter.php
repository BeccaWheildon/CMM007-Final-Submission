<?php
include("../DBConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $sql_books = "SELECT books.*, bookcovers.imagePath 
              FROM books
              LEFT JOIN bookcovers ON books.bookID = bookcovers.bookID
              WHERE books.quantity > 0";

            $genreFilter = isset($_GET["genre_name"]) ? trim($_GET["genre_name"]) : "";

        if (!empty($genreFilter)) {
            $sql_books .= " AND books.genre = :genreFilter
                GROUP BY books.bookID 
                ORDER BY uploadDate DESC";


            $stmt = $db->prepare($sql_books);
            $stmt->execute(["genreFilter" => $genreFilter]);
        } else {
            $stmt = $db->query($sql_books);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header("Content-type: application/json");
        http_response_code(200);
        echo json_encode($result);

        $db = null;
    } catch (PDOException $exception) {
        // Log the error and provide a generic error message
        error_log($exception->getMessage(), 3, '/path/to/error_log.txt');
        http_response_code(500);
        echo json_encode(["error" => "An unexpected error occurred."]);
    }
} else {
    // Handle unsupported HTTP methods
    http_response_code(400);
    echo json_encode(["error" => "Only GET requests are supported."]);
}
?>
