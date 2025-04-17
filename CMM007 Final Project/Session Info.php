<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION['userName'])) {
  header("Location:Login Page/Login Page.html");
  exit();
}
  
  $email = $_SESSION['email'];
  $userName = $_SESSION['userName'];
  $userID = $_SESSION['userID'];
  $userType = $_SESSION['userType'];


?>