<!DOCTYPE html>
<html>
<head>
    <title>Enter Data</title>
</head>
<body>

<h2>Enter Data</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="sr_no">Sr No:</label><br>
    <input type="text" id="sr_no" name="sr_no"><br>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    
    <label for="category">Category:</label><br>
    <select id="category" name="category">
        <option value="MONITOR">Monitor</option>
        <option value="CPU">CPU</option>
        <option value="POWER SUPPLY">Power Supply</option>
        <option value="DMM">DMM</option>
        <option value="KIT">Kit</option>
        <option value="FUNCTION GENERATOR">Function Generator</option>
    </select><br>
    
    <label for="origin_lab">Origin Lab:</label><br>
    <input type="text" id="origin_lab" name="origin_lab"><br>
    
    <label for="location">Location:</label><br>
    <input type="text" id="location" name="location"><br>
    
    <label for="_status_">Status:</label><br>
    <select id="_status_" name="_status_">
        <option value="WORKING">WORKING</option>
        <option value="MAINTANANCE">MAINTANANCE</option>
        <option value="DISCARDED">DISCARDED</option>
        <option value="ISSUED">ISSUED</option>
        <option value="LOST">LOST</option>
        <option value="UNKNOWN">UNKNOWN</option>
    </select><br>
    
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "ims"; // Your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $sr_no = $_POST['sr_no'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $origin_lab = $_POST['origin_lab'];
    $location = $_POST['location'];
    // Check if the '_status_' field is set in the form
    $status = isset($_POST['_status_']) ? $_POST['_status_'] : '';

    // Prepare SQL statement to insert data into the table
    $sql = "INSERT INTO components (sr_no, name, category, origin_lab, location, _status_) VALUES ('$sr_no', '$name', '$category', '$origin_lab', '$location', '$status')";

    if ($conn->query($sql) === TRUE) {
      echo "<p>New record created successfully</p>";
      
      // Update last_entry_date for the inserted record
      $last_entry_date = date('Y-m-d H:i:s'); // Current date and time
      $sql_update = "UPDATE components SET last_entry_date='$last_entry_date' WHERE sr_no='$sr_no'";
      $conn->query($sql_update);
    } else {
      echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>

</body>
</html>
