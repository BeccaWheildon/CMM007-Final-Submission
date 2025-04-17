<?php
require_once "../DBConnect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $usertype = isset($_POST['userType']) ? $_POST['userType'] : null;

    if (empty($email) || empty($password) || empty($usertype)) {
        echo "<script type='text/javascript'>
                alert('Please fill out all fields.');
                window.location.href = 'Login Page.html';
              </script>";
        exit();
    }

    try {
        $sql = "SELECT * FROM userdetails WHERE email = :email";
        $query = $db->prepare($sql);
        $query->execute([':email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($usertype === $result['userType']) {
                if (password_verify($password, $result['password'])) {
                    session_regenerate_id();
                    $_SESSION['userName'] = $result['userName'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['userType'] = $result['userType'];
                    $_SESSION['userID'] = $result['userID'];

                    if ($result['userType'] == "User") {
                        echo "<script>window.location.href = '../User Dashboard/User Dashboard.php';</script>";
                        exit();
                    } elseif ($result['userType'] == "Admin") {
                        echo "<script>window.location.href = '../Admin Dashboard/Admin Dashboard.php';</script>";
                        exit();
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Incorrect password.'); window.history.back();</script>";
                    exit();
                }
            } else {
                echo "<script type='text/javascript'>alert('User type does not match.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script type='text/javascript'>alert('Invalid email address.'); window.history.back();</script>";
            exit();
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../logs/errors.log');
        echo "<script>alert('A database error occurred. Please try again later.');</script>";
        exit();
    }
}
?>
