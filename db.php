<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>