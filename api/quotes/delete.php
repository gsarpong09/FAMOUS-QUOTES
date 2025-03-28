<?php
// Set response headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Validate input
if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$quote->id = $data->id;

// Attempt delete
if ($quote->delete()) {
    echo json_encode(['id' => $quote->id]);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
