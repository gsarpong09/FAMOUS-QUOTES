<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include DB and model
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Get raw input data
$data = json_decode(file_get_contents("php://input"));

// Check if id is provided
if (!isset($data->id) || empty($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Set ID to delete
$category->id = $data->id;

// Attempt delete
if ($category->delete()) {
    echo json_encode(['id' => $category->id]);
} else {
    echo json_encode(['message' => 'Category Not Deleted']);
}
?>
