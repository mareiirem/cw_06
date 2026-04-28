<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "rali24";
$pass = "rali24";
$db   = "rali24";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

echo "Connection successful";
?>