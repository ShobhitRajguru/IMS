<?php
// Include database connection
include_once 'db_connect.php';

// Function to generate a random four-digit ID
function generateID() {
    return str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
}

// Handle component actions
if(isset($_POST['submit'])) {
    // Insert new component
    $id = generateID(); // Generate a random four-digit ID
    $name = $_POST['name'];
    $category = $_POST['category'];
    $lab_no = $_POST['lab_no']; // New lab number field
    
    $sql = "INSERT INTO components (id, name, category, lab_no) VALUES ('$id', '$name', '$category', '$lab_no')"; // Updated query
    
    if ($conn->query($sql) === TRUE) {
        echo "New component added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif(isset($_POST['update'])) {
    // Update component
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    
    $sql = "UPDATE components SET name='$name', category='$category' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Component updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} elseif(isset($_POST['delete'])) {
    // Delete component
    $id = $_POST['id'];
    
    $sql = "DELETE FROM components WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Component deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Components</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
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
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button[type="submit"] {
            display: block;
            width: 100%;
            background-color: #008CBA;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        button[type="submit"]:hover {
            background-color: #0073e6;
        }
    </style>
</head>
<body>
    <h2>Add New Component</h2>
    <form method="post" action="">
        <!-- Remove input field for ID -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="PC">PC</option>
            <option value="DMM">DMM</option>
            <option value="CRO">CRO</option>
            <option value="FPGA_BOARD">FPGA Board</option>
            <option value="TUBELIGHTS">Tubelights</option>
            <option value="FANS">Fans</option>
            <option value="OTHERS">Others</option>
        </select>
        <label for="lab_no">Lab Number:</label> <!-- New lab number field -->
        <input type="text" id="lab_no" name="lab_no" required> <!-- New lab number field -->
        <input type="submit" name="submit" value="Add Component">
    </form>

    <h2>Edit or Delete Component</h2>
    <form method="post" action="">
        <label for="id">Component ID:</label>
        <input type="number" id="id" name="id" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Leave empty to keep unchanged">
        <label for="category">Category:</label>
        <select id="category" name="category" placeholder="Leave empty to keep unchanged">
            <option value="PC">PC</option>
            <option value="DMM">DMM</option>
            <option value="CRO">CRO</option>
            <option value="FPGA_BOARD">FPGA Board</option>
            <option value="TUBELIGHTS">Tubelights</option>
            <option value="FANS">Fans</option>
            <option value="OTHERS">Others</option>
        </select>
        <input type="submit" name="update" value="Update Component">
        <input type="submit" name="delete" value="Delete Component">
    </form>

    <form method="get" action="view_components.php">
        <button type="submit">View Components</button>
    </form>
</body>
</html>
