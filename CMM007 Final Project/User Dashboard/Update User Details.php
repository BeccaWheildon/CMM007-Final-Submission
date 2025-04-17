<?php
session_start(); 
error_reporting(E_ALL);
require_once "../DBConnect.php";

try {
    $userID = $_SESSION['userID']; 

    // Retrieve and sanitize POST data
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate Full Name
    if (empty($userName)) {
        echo "<script>
                alert('Full name is required.');
                window.history.back();
              </script>";
        exit();
    }

    // Validate Email
    if (empty($email)) {
        echo "<script>
                alert('Email is required.');
                window.history.back();
              </script>";
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Invalid email format.');
                window.history.back();
              </script>";
        exit();
    }

    // Prepare SQL statement for updating user details
    $stmt = $db->prepare("UPDATE userdetails SET userName = :userName, email = :email WHERE userId = :userId");
    $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':userId', $userID, PDO::PARAM_INT);

    if ($stmt->execute()) {
      // Update session variables
      $_SESSION['userName'] = $userName;
      $_SESSION['email'] = $email;

      echo "<script>
              alert('User details updated successfully.');
              window.location.href = 'User Dashboard.php'; // Redirect to dashboard
            </script>";
  } else {
      echo "<script>
              alert('Failed to update user details. Please try again.');
              window.history.back();
            </script>";
  }
} catch (PDOException $exception) {
  error_log($exception->getMessage(), 3, '../logs/errors.log');
  echo "<script>
          alert('A database error occurred: " . htmlspecialchars($exception->getMessage()) . "');
          window.history.back();
        </script>";
}
?>
