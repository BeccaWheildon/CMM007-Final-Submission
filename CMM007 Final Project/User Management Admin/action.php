<?php

// Code created referencing YouTube video - https://www.youtube.com/watch?v=nd9nOQemVAc&t=158s

include("../DBConnect.php");

header("Content-Type: application/json");

try {
    if (!isset($_POST['action'])) {
        echo json_encode(['error' => "'action' key is missing in the request"]);
        exit;
    }

    if ($_POST['action'] === 'edit') {
        $data = array(
            ':userName' => $_POST["userName"],
            ':email'    => $_POST["email"],
            ':userType' => $_POST["userType"],
            ':userID'   => $_POST["userID"]
        );

        $sql = "
        UPDATE userdetails
        SET userName = :userName,
            email = :email,
            userType = :userType
        WHERE userID = :userID
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        echo json_encode([
            'action' => $_POST['action'],
            'userID' => $_POST['userID']
        ]);
        exit;
    }

    if ($_POST['action'] === 'delete') {
        $data = array(':userID' => $_POST["userID"]);

        $sql = "DELETE FROM userdetails WHERE userID = :userID";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        echo json_encode([
            'action' => $_POST['action'],
            'userID' => $_POST['userID']
        ]);
        exit;
    }

    echo json_encode(['error' => "Invalid action specified"]);
    exit;

} catch (PDOException $exception) {
    error_log($exception->getMessage(), 0);
    http_response_code(500);
    echo json_encode(['error' => "An internal server error occurred"]);
    exit;
}

?>