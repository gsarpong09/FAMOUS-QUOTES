header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$quote->id = $_GET['id'];

$result = $quote->read_single()->fetch(PDO::FETCH_ASSOC);
echo $result ? json_encode($result) : json_encode(['message' => 'No Quotes Found']);
