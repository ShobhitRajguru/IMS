<?php
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ims";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the registration form
$username = $_POST['username'];
$password = $_POST['password'];
$birth_year = $_POST['birth_year'];
$lab_no = $_POST['lab_no'];

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user information into the database
$sql = "INSERT INTO users (username, password, birth_year, lab_no) VALUES ('$username', '$hashed_password', '$birth_year', '$lab_no')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    echo "Registration successful!<br>";
    echo "<a href='register.php'>Register again</a><br>";
    echo "<a href='login.php'>Sign in</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
