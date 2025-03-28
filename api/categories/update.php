header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->category)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
}

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$category->id = $data->id;
$category->category = $data->category;

if ($category->update()) {
    echo json_encode(['id' => $category->id, 'category' => $category->category]);
} else {
    echo json_encode(['message' => 'category_id Not Found']);
}
