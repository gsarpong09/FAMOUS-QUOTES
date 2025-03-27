<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$result = $quote->read();

$quotes = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $quotes[] = ['id' => $id, 'quote' => $quote, 'author' => $author, 'category' => $category];
}
echo json_encode($quotes);
