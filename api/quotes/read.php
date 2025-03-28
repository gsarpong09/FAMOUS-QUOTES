<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();


$quote = new Quote($db);


if (isset($_GET['id'])) {
    $result = $quote->read_single($_GET['id']);
} elseif (isset($_GET['author_id']) && isset($_GET['category_id'])) {
    $result = $quote->read_by_author_and_category($_GET['author_id'], $_GET['category_id']);
} elseif (isset($_GET['author_id'])) {
    $result = $quote->read_by_author($_GET['author_id']);
} elseif (isset($_GET['category_id'])) {
    $result = $quote->read_by_category($_GET['category_id']);
} else {
    $result = $quote->read();
}

if ($result && $result->rowCount() > 0) {
    $quotes_arr = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quotes_arr[] = [
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        ];
    }
    echo json_encode($quotes_arr);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
