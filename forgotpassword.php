<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 5px;
        }
        .success-message {
            color: green;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="forgotpassword.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="birth_year">Birth Year:</label><br>
        <input type="number" id="birth_year" name="birth_year" min="1900" max="2022" required><br>
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password"><br>
        <input type="submit" value="Submit">
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

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $birth_year = $_POST['birth_year'];
            $new_password = $_POST['new_password']; // Get the new password from the form

            if (!empty($new_password)) { // Check if the new password field is not empty
                // Query the database to retrieve the user's birth year
                $sql = "SELECT birth_year FROM users WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $stored_birth_year = $row['birth_year'];

                    if ($birth_year == $stored_birth_year) {
                        // Birth year matches, update the user's password in the database
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
                        $update_sql = "UPDATE users SET password = ? WHERE username = ?";
                        $update_stmt = $conn->prepare($update_sql);
                        $update_stmt->bind_param("ss", $hashed_password, $username);
                        $update_stmt->execute();

                        echo "<div class='success-message'>Password reset successfully. <a href='login.php'>Go to Login Page</a></div>";
                    } else {
                        // Birth year does not match
                        echo "<div class='error-message'>Incorrect birth year.</div>";
                    }
                } else {
                    // Username not found
                    echo "<div class='error-message'>Username not found.</div>";
                }
            } else {
                // New password field is empty
                echo "<div class='error-message'>Please enter a new password.</div>";
            }
        }

        $conn->close();
        ?>
    </form>
</body>
</html>
