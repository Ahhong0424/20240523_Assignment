<?php
$host = 'localhost'; // Your database host
$db = 'may'; // Your database name
$user = 'root'; // Your database user
$pass = ''; // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
