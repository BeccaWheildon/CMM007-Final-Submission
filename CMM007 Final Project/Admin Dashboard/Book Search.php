<?php
include("../DBConnect.php");    
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $sql_books= "SELECT * FROM books";
        $keyword1 = isset($_GET["keyword1"]) ? trim($_GET["keyword1"]) : "";
        if (!empty($keyword1)) {
            $sql_books .= " WHERE title LIKE :keyword1 OR author LIKE :keyword1";
            $stmt = $db->prepare($sql_books);
            $stmt->execute(['keyword1' => '%' . $keyword1 . '%']);
        } else {
            $stmt = $db->query($sql_books);
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-type: application/json");
        http_response_code(200);
        echo json_encode(empty($result) ? ["message" => "No books found."] : $result);

        $db = null;
    } 
     
    catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode(["error" => "An internal server error occurred."]);
    }
    } else {
    http_response_code(400);
    echo json_encode(["error" => "Only GET requests are supported."]);
}

?>
