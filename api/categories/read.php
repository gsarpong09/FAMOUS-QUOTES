<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$result = $category->read();

$categories = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $categories[] = ['id' => $id, 'category' => $category];
}
echo json_encode($categories);
