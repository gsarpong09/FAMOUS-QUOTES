header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$author->id = $data->id;
$author->author = $data->author;

if ($author->update()) {
    echo json_encode(['id' => $author->id, 'author' => $author->author]);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}
