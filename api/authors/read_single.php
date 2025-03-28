<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Check for ID parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$author->id = $_GET['id'];
$author->read_single();

if ($author->author !== null) {
    echo json_encode([
        'id' => $author->id,
        'author' => $author->author
    ]);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'author_id Not Found']);
}
?>
