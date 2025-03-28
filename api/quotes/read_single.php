<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Check for ID parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$quote->id = $_GET['id'];
$quote->read_single();

if ($quote->quote !== null) {
    echo json_encode([
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    ]);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Quotes Found']);
}
?>
