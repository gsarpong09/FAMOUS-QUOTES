<?php
// Set headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->author)) {
    $author->author = $data->author;

    if ($author->create()) {
        echo json_encode([
            'id' => $author->id,
            'author' => $author->author
        ]);
    } else {
        echo json_encode(['message' => 'Author Not Created']);
    }
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
