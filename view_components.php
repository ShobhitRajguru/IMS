<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Components</title>
    <style>
        /* Define CSS styles for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50; /* Green */
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        }
        .container {
        text-align: center; /* Center align its children */
        }
        /* Hover effect */
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container to center the button -->
    <h2>View Components</h2>
    <!--button onclick="window.location.href = 'edit_components.php';" class="btn">Add New Component</button><br><br-->
    <form method="get" action="dashboard.php">
        <button type="submit" class="btn">Go to Dashboard</button><br><br>
    </form>
    </div>
    <?php
// Start the session
session_start();

// Include database connection
include_once 'db_connect.php';

// Function to fetch components based on lab_no
function fetchComponentsByLabNo($conn, $lab_no) {
    // Prepare a SQL statement to retrieve components based on lab_no
    $sql = "SELECT * FROM components WHERE location = '$lab_no' ORDER BY category";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Sr_No</th><th>Name</th><th>Category</th><th>TimeStamp</th><th>Status</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["sr_no"]. "</td>";
            echo "<td>" . $row["name"]. "</td>";
            echo "<td>" . $row["category"]. "</td>";
            echo "<td>" . $row["last_entry_date"]. "</td>";
            echo "<td>" . $row["_status_"]. "</td>";
            echo "<td>";
            echo "<form method='post' action='update_status.php'>";
            echo "<input type='hidden' name='sr_no' value='" . $row["sr_no"] . "'>";
            echo "<select name='status'>";
            echo "<option value='WORKING'>WORKING</option>";
            echo "<option value='MAINTANANCE'>MAINTANANCE</option>";
            echo "<option value='DISCARDED'>DISCARDED</option>";
            echo "<option value='ISSUED'>ISSUED</option>";
            echo "<option value='LOST'>LOST</option>";
            echo "<option value='UNKNOWN'>UNKNOWN</option>";
            echo "</select>";
            echo "<input type='submit' name='submit' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

// Check if lab_no is set in the session
if (isset($_SESSION['lab_no'])) {
    $lab_no = $_SESSION['lab_no'];
    
    // Call the function to fetch components based on lab_no
    fetchComponentsByLabNo($conn, $lab_no);
} else {
    // If lab_no is not set in the session, display an error message
    echo "Lab number not set in session.";
}

// Close database connection
$conn->close();
?>

</body>
</html>
