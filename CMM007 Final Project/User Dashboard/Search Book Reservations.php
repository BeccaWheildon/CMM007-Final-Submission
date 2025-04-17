<?php

include("../DBConnect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_SESSION['email'] ?? null;
    $keyword = $_GET['keyword'] ?? ''; // Initialize the keyword to avoid undefined variable errors

    if ($email) {
        try {
            $sql = "SELECT b.title, b.author, r.reservationDate, r.returnDate, r.bookID 
                    FROM bookreservation r
                    INNER JOIN books b
                    ON r.bookID = b.bookID
                    WHERE r.reservationEmail = :email";

            if (!empty($keyword)) {
                $sql .= " AND (b.title LIKE :keyword OR b.author LIKE :keyword)";
            }

            $sql .= " ORDER BY returnDate DESC";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);

            if (!empty($keyword)) {
                $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode(empty($result) ? ["message" => "No books found."] : $result);
        } catch (PDOException $exception) {
            // Log the detailed error message for debugging
            error_log("Database Error: " . $exception->getMessage());
            http_response_code(500);
            echo json_encode(["error" => "An internal server error occurred."]);
        } finally {
            $db = null; // Ensure the connection is closed
        }
    } else {
        http_response_code(401); // Return "Unauthorized" for missing session email
        echo json_encode(["error" => "Session email not found"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Only GET requests are supported."]);
}

?>
