<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database and model
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate quote
$quote = new Quote($db);

// Get raw POSTed data
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['quote']) || 
    !isset($data['author_id']) || 
    !isset($data['category_id'])
) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$quote->quote = $data['quote'];
$quote->author_id = $data['author_id'];
$quote->category_id = $data['category_id'];

// Check if author_id and category_id exist in database
if (!$quote->isValidAuthor()) {
    echo json_encode(['message' => 'author_id Not Found']);
    exit;
}

if (!$quote->isValidCategory()) {
    echo json_encode(['message' => 'category_id Not Found']);
    exit;
}

// Create quote
if ($quote->create()) {
    echo json_encode([
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
    ]);
} else {
    echo json_encode(['message' => 'Quote Not Created']);
}
