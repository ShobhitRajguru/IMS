<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password is set
$dbname = "ims"; // Replace "your_database_name" with the actual name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
