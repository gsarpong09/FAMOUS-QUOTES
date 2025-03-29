<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include DB and Author model
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$author = new Author($db);

// Validate and get id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['message' => 'Missing or invalid id parameter']);
    exit();
}

// Set ID and get data
$author->id = $_GET['id'];
$result = $author->read_single();

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}
?>
