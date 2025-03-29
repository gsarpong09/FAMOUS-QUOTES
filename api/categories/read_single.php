<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include DB and Category model
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

// Validate and get id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['message' => 'Missing or invalid id parameter']);
    exit();
}

// Set ID and get data
$category->id = $_GET['id'];
$result = $category->read_single();

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'category_id Not Found']);
}
?>
