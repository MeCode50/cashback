<?php
include_once 'functions/init.php';

// Get the brand from the Ajax request
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';

// Validate brand and prevent SQL injection
if ($brand) {
    // Call the existing function to retrieve the device names for the given brand
    $deviceNames = getDeviceName($brand);
    // Return the device names as a JSON response
    echo json_encode($deviceNames);
} else {
    // If no brand is selected, return an empty array
    echo json_encode([]);
}
