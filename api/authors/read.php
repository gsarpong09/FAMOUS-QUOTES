header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$result = $author->read();

$authors = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $authors[] = ['id' => $id, 'author' => $author];
}
echo json_encode($authors);
