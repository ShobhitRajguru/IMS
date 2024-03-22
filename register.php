<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        /* Basic CSS styles for form layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            text-align: center; /* Center align the heading */
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="number"],
        input[type="submit"] {
            display: block;
            width: 100%;
            margin-top: 8px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="register_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="birth_year">Birth Year:</label>
        <input type="number" id="birth_year" name="birth_year" min="1900" max="2022" required>

        <label for="lab_no">Lab Number:</label>
        <input type="text" id="lab_no" name="lab_no" required>

        <input type="submit" value="Register">
    </form>
</body>
</html>
