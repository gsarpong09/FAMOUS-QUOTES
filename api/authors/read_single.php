header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$author->id = $_GET['id'];

$result = $author->read_single()->fetch(PDO::FETCH_ASSOC);
echo $result ? json_encode($result) : json_encode(['message' => 'author_id Not Found']);
