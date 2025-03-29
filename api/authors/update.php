<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database and model
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$author = new Author($db);

// Get raw PUT data
$data = json_decode(file_get_contents("php://input"));

// Validate required fields
if (!isset($data->id) || !isset($data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Set ID and new author name
$author->id = $data->id;
$author->author = $data->author;

// Attempt update
if ($author->update()) {
    echo json_encode([
        'id' => $author->id,
        'author' => $author->author
    ]);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}
?>
