<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$author->id = $data->id;

if ($author->delete()) {
    echo json_encode(['id' => $author->id]);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}
