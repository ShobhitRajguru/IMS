<?php
// Establish a MySQL connection
$mysqli = new mysqli("localhost", "root", "", "ims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve the sr_no from the URL or form submission
if(isset($_GET['sr_no'])) {
    $sr_no = $_GET['sr_no'];
} elseif(isset($_POST['sr_no'])) {
    $sr_no = $_POST['sr_no'];
} else {
    echo "No sr_no provided.";
    exit;
}

// Fetch the component details based on the sr_no from your database
// Perform your MySQL query to retrieve the component details
// Example:
$query = "SELECT * FROM components WHERE sr_no = '$sr_no'";
$result = $mysqli->query($query);

// Display the component details
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display the component details here
    echo "Component details for sr_no: " . $row['sr_no'];
    
    // Display form for updating status
    //echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
    //echo "<input type='hidden' name='sr_no' value='" . $row['sr_no'] . "'>";
    //echo "<label for='status'>Select Status:</label>";
    //echo "<select name='status' id='status'>";
    //echo "<option value='MONITOR'>MONITOR</option>";
    //echo "<option value='CPU'>CPU</option>";
    //echo "<option value='POWER_SUPPLY'>POWER_SUPPLY</option>";
    //echo "<option value='DMM'>DMM</option>";
    //echo "<option value='KIT'>KIT</option>";
    //echo "<option value='FUNCTION_GENERATOR'>FUNCTION_GENERATOR</option>";
    //echo "</select>";
    //echo "<input type='submit' name='submit' value='Update Status'>";
    //echo "</form>";

    // Handle form submission
    if(isset($_POST['submit'])) {
        // Retrieve the status from the form submission
        if(isset($_POST['status'])) {
            $status = $_POST['status'];

            // Update the status in the database
            // Perform your MySQL query to update the status
            // Example:
            $update_query = "UPDATE components SET _status_ = '$status' WHERE sr_no = '$sr_no'";
            if($mysqli->query($update_query) === TRUE) {
                echo "Status updated successfully.";
            } else {
                echo "Error updating status: " . $mysqli->error;
            }
        } else {
            echo "No status provided.";
        }
    }
} else {
    echo "Component not found.";
}

// Close the MySQL connection
$mysqli->close();
?>
