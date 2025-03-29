<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database and model
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get ID from URL
$quote->id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$quote->id) {
    echo json_encode(['message' => 'Missing Required Parameter: id']);
    http_response_code(400);
    exit;
}

// Read single quote
if ($quote->read_single()) {
    $quote_arr = [
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    ];
    echo json_encode($quote_arr);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
    http_response_code(404);
}
?>
