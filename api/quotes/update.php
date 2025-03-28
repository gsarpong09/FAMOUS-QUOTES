<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include DB & model
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB
$database = new Database();
$db = $database->connect();

// Instantiate Quote
$quote = new Quote($db);

// Get raw input
$data = json_decode(file_get_contents("php://input"), true);

// Validate required parameters
if (
    !isset($data['id']) ||
    !isset($data['quote']) ||
    !isset($data['author_id']) ||
    !isset($data['category_id'])
) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

// Assign data to object
$quote->id = $data['id'];
$quote->quote = $data['quote'];
$quote->author_id = $data['author_id'];
$quote->category_id = $data['category_id'];

// Validate ID exists
if (!$quote->exists()) {
    echo json_encode(['message' => 'No Quotes Found']);
    exit;
}

// Validate foreign keys
if (!$quote->isValidAuthor()) {
    echo json_encode(['message' => 'author_id Not Found']);
    exit;
}

if (!$quote->isValidCategory()) {
    echo json_encode(['message' => 'category_id Not Found']);
    exit;
}

// Attempt to update
if ($quote->update()) {
    echo json_encode([
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
    ]);
} else {
    echo json_encode(['message' => 'Quote Not Updated']);
}
