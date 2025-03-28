<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Quote.php';


$database = new Database();
$db = $database->connect();


$quote = new Quote($db);


$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;
$author_id = isset($_GET['author_id']) && is_numeric($_GET['author_id']) ? intval($_GET['author_id']) : null;
$category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) ? intval($_GET['category_id']) : null;


if ($id !== null) {
    $result = $quote->read_single($id);
} elseif ($author_id !== null && $category_id !== null) {
    $result = $quote->read_by_author_and_category($author_id, $category_id);
} elseif ($author_id !== null) {
    $result = $quote->read_by_author($author_id);
} elseif ($category_id !== null) {
    $result = $quote->read_by_category($category_id);
} else {
    $result = $quote->read();
}


if (!empty($result)) {
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No quotes found']);
}
