<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $received_data = $_POST['data'];
    echo "Received data: " . $received_data;
}
?>
