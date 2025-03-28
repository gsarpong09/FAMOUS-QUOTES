header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$author->author = $data->author;

if ($author->create()) {
    echo json_encode(['id' => $db->lastInsertId(), 'author' => $author->author]);
} else {
    echo json_encode(['message' => 'Author Not Created']);
}
