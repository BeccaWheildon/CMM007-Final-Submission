<?php

// Code created referencing YouTube video - https://www.youtube.com/watch?v=nd9nOQemVAc&t=158s

include('../DBConnect.php');

try {
    $columns = array("userID", "userName", "email", "userType");
    $query = "SELECT * FROM userdetails";

   
    if (isset($_POST["search"]["value"]) && !empty(trim($_POST["search"]["value"]))) {
        $query .= " WHERE userName LIKE :search OR email LIKE :search";
    }

    if (isset($_POST["order"]) && isset($columns[$_POST['order']['0']['column']])) {
        $orderColumn = $columns[$_POST['order']['0']['column']];
        $orderDirection = ($_POST['order']['0']['dir'] === 'asc') ? 'ASC' : 'DESC';
        $query .= " ORDER BY $orderColumn $orderDirection";
    } else {
        $query .= " ORDER BY userID DESC";
    }


    $start = isset($_POST["start"]) ? intval($_POST["start"]) : 0;
    $length = isset($_POST["length"]) && $_POST["length"] != -1 ? intval($_POST["length"]) : 10;
    $query .= " LIMIT :start, :length";
    $statement = $db->prepare($query);

    if (isset($_POST["search"]["value"]) && !empty(trim($_POST["search"]["value"]))) {
        $statement->bindValue(':search', '%' . trim($_POST["search"]["value"]) . '%', PDO::PARAM_STR);
    }

    $statement->bindValue(':start', $start, PDO::PARAM_INT);
    $statement->bindValue(':length', $length, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $data = array_map(function ($row) {
        return array_map('htmlspecialchars', $row);
    }, $result);

    $totalQuery = "SELECT COUNT(*) FROM userdetails";
    $totalStmt = $db->prepare($totalQuery);
    $totalStmt->execute();
    $recordsTotal = $totalStmt->fetchColumn();

    $filteredQuery = "SELECT COUNT(*) FROM userdetails";
    if (isset($_POST["search"]["value"]) && !empty(trim($_POST["search"]["value"]))) {
        $filteredQuery .= " WHERE userName LIKE :search OR email LIKE :search";
    }

    $filteredStmt = $db->prepare($filteredQuery);

    if (isset($_POST["search"]["value"]) && !empty(trim($_POST["search"]["value"]))) {
        $filteredStmt->bindValue(':search', '%' . trim($_POST["search"]["value"]) . '%', PDO::PARAM_STR);
    }

    $filteredStmt->execute();
    $recordsFiltered = $filteredStmt->fetchColumn();

    $output = array(
        'draw' => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'data' => $data
    );

    header("Content-Type: application/json");
    echo json_encode($output, JSON_PRETTY_PRINT);
    exit;
} catch (PDOException $exception) {

    error_log($exception->getMessage(), 0);
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => "An internal server error occurred."]);
}
