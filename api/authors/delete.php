<?php
// Set response headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get raw input data
$data = json_decode(file_get_contents("php://input"));

// Validate input
if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

// Set ID to delete
$author->id = $data->id;

// Attempt to delete
if ($author->delete()) {
    echo json_encode(['id' => $author->id]);
} else {
    echo json_encode(['message' => 'Author Not Deleted']);
}
