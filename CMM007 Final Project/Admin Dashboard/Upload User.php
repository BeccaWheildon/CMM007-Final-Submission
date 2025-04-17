<?php
error_reporting(E_ALL);
require_once "../DBConnect.php";

try {
    
    // UPLOAD USER DETAILS INTO DATABASE
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $userType = $_POST["userType"];
    

    $stmt = $db->prepare("INSERT INTO userdetails (userName, email, password, userType) 
    VALUES (:userName, :email, :password, :userType)");


$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->bindParam(':userType', $userType, PDO::PARAM_STR);


$stmt->execute();

echo "<script>
        alert('User has been added successfully.');
        window.location.href='Admin Dashboard.php';
      </script>";

} catch (PDOException $exception) {
    error_log($exception->getMessage(), 3, '../logs/errors.log');
echo "<script>
    alert('An error has occured: ". $exception->getMessage() . "');
    window.location.href='Admin Dashboard.php';
      </script>";
}
?>
