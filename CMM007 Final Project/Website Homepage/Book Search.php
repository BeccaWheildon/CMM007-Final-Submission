<?php

//PHP FILE FOR HOMEPAGE SEARCH BAR

include("../DBConnect.php");    

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $sql_books = "SELECT books.*, bookcovers.imagePath 
              FROM books
              LEFT JOIN bookcovers ON books.bookID = bookcovers.bookID
              WHERE books.quantity > 0";
                      
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]) : "";

        if (!empty($keyword)) {
            $sql_books .= " AND (title LIKE :keyword OR author LIKE :keyword)";
        }

        $sql_books .= " GROUP BY books.bookID 
                        ORDER BY uploadDate DESC";

        $stmt = $db->prepare($sql_books);

        if (!empty($keyword)) {
            $stmt->execute(['keyword' => '%' . $keyword . '%']);
        } else {
            $stmt->execute();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-type: application/json");
        http_response_code(200);
        echo json_encode(empty($result) ? ["message" => "No books found."] : $result);
    } 
    catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode(["error" => "An internal server error occurred."]);
    } 
    finally {
        $db = null;
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Only GET requests are supported."]);
}
?>
