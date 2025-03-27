<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

if (isset($_GET['author_id']) && isset($_GET['category_id'])) {
    $quote->author_id = $_GET['author_id'];
    $quote->category_id = $_GET['category_id'];
    $result = $quote->read_by_author_and_category();
} elseif (isset($_GET['author_id'])) {
    $quote->author_id = $_GET['author_id'];
    $result = $quote->read_by_author();
} elseif (isset($_GET['category_id'])) {
    $quote->category_id = $_GET['category_id'];
    $result = $quote->read_by_category();
} else {
    $result = $quote->read_all();
}

$num = $result->rowCount();

if ($num > 0) {
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
