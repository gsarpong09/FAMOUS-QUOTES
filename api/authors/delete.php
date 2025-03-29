<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include DB and model
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get raw DELETE input
$data = json_decode(file_get_contents("php://input"));

// Validate required parameter
if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Set ID
$author->id = $data->id;

// Attempt deletion
if ($author->delete()) {
    echo json_encode(['id' => $author->id]);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}
?>
