<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qrData = $_POST['qr_data'];
    // Process the QR code data here, e.g., update the database
    echo 'QR Code data received: ' . $qrData;
} else {
    echo 'Invalid request method';
}
?>
