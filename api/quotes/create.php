<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->create()) {
    echo json_encode(['message' => 'Quote Created']);
} else {
    echo json_encode(['message' => 'Quote Not Created']);
}
