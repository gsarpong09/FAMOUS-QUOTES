<?php
// Set response headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Get raw input
$data = json_decode(file_get_contents("php://input"));

// Validate input
if (!isset($data->id) || !isset($data->category)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

// Assign to object
$category->id = $data->id;
$category->category = $data->category;

// Attempt to update
if ($category->update()) {
    echo json_encode([
        'id' => $category->id,
        'category' => $category->category
    ]);
} else {
    echo json_encode(['message' => 'Category Not Updated']);
}
