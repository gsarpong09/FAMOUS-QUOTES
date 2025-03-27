<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$quote->id = $data->id;

if ($quote->delete()) {
    echo json_encode(['message' => 'Quote Deleted']);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
