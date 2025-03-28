<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$result = $category->read();

if ($result) {
    if ($result->rowCount() > 0) {
        $data = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $data[] = [
                'id' => $id,
                'category' => $category
            ];
        }

        http_response_code(200);
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'No categories found.']);  
    }
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to query database.']);
}
