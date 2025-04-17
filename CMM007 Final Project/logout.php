<?php
session_start();

session_unset();
session_destroy();

echo "<script type='text/javascript'>alert('You have successfully logged out');</script>";
echo "<script>window.location.href = 'Website Homepage/homepage.php';</script>";
exit;
?>