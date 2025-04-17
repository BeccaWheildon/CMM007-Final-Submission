<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "127.0.0.1";
$dbname = "db1701522_cmm007";
$dbusername = "root";
$dbpassword = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;", $dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $db = false;
}


?>
