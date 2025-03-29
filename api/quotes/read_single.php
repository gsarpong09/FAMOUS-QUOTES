<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database and object files
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Check for ID param
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['message' => 'Missing or invalid id parameter']);
    exit();
}

// Set ID and try to get quote
$quote->id = $_GET['id'];
$result = $quote->read_single();

// Return result or error
if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
?>
