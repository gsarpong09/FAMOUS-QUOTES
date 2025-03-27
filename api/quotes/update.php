<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->update()) {
    echo json_encode(['message' => 'Quote Updated']);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
