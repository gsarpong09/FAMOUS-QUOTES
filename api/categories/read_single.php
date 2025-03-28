<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Check for ID parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$category->id = $_GET['id'];
$category->read_single();

if ($category->category !== null) {
    echo json_encode([
        'id' => $category->id,
        'category' => $category->category
    ]);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'category_id Not Found']);
}
?>
