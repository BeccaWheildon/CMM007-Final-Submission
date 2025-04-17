<?php
require '../Session Info.php';
require '../DBConnect.php';

session_start();
$email = $_SESSION['email'] ?? '';

if (!$email) {
    echo "<script>alert('Unauthorized access.'); window.location.href='index.php';</script>";
    exit();
}

$old_password = trim($_POST['old_password'] ?? '');
$new_password = trim($_POST['new_password'] ?? '');

if (empty($old_password) || empty($new_password)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit();
}

if (strlen($new_password) < 8) {
    echo "<script>alert('New password must be at least 8 characters!'); window.history.back();</script>";
    exit();
}

if (!preg_match('/[a-z]/', $new_password) || !preg_match('/[A-Z]/', $new_password) || !preg_match('/[0-9]/', $new_password)) {
    echo "<script>alert('Password must contain at least one lowercase letter, one uppercase letter, and one number.'); window.history.back();</script>";
    exit();
}

try {
    $stmt = $db->prepare("SELECT password FROM userdetails WHERE email = ?");
    if (!$stmt->execute([$email])) {
        print_r($stmt->errorInfo());
        exit();
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($old_password, $user['password'])) {
        echo "<script>alert('Old password is incorrect!'); window.history.back();</script>";
        exit();
    }

    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $update_stmt = $db->prepare("UPDATE userdetails SET password = ? WHERE email = ?");
    if ($update_stmt->execute([$new_password_hash, $email])) {
        echo "<script>alert('Password updated successfully!'); window.location.href='User Dashboard.php';</script>";
    } else {
        print_r($update_stmt->errorInfo());
        exit();
    }
} catch (PDOException $exception) {
    error_log($exception->getMessage(), 3, '../logs/errors.log');
    echo "<script>alert('A database error occurred. Please try again later.'); window.history.back();</script>";
}
?>
