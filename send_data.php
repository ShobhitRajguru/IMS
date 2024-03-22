<?php
// Check if data is set in the POST request
if(isset($_POST['data'])) {
    // Retrieve the data from the form
    $data = $_POST['data'];
    
    // Define Flask endpoint URL
    $flask_endpoint = "http://localhost:5000/receive";

    // Prepare POST data for Flask
    $post_data = http_build_query(array('data' => $data));

    // Set up cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $flask_endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL session
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Print response from Flask
    echo "Response from Flask: " . $response;
} else {
    // If 'data' key is not set in the POST request, handle the error
    echo "Error: 'data' key is not set in the POST request";
}
?>
