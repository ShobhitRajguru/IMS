<?php
// Start session
session_start();

// Your database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get admin input from the form
    $name = $_POST['name'];
    $password = $_POST['password'];
    $lab_no = $_POST['lab_no']; // Adding lab_no

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO admin (username, password, lab_no) VALUES (?, ?, ?)"); // Added lab_no
    $stmt->bind_param("ssi", $name, $hashed_password, $lab_no); // Changed "ss" to "ssi"

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Admin registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
</head>
<body>
    <h2>Admin Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="lab_no">Lab Number:</label> <!-- Added lab_no -->
        <input type="text" id="lab_no" name="lab_no" required> <!-- Added lab_no -->

        <input type="submit" value="Register">
    </form>
</body>
</html>
