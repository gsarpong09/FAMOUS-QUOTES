<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode([
    'message' => 'Welcome to the Famous Quotes API!',
    'routes' => [
        '/quotes/' => 'Access all quote endpoints',
        '/authors/' => 'Access all author endpoints',
        '/categories/' => 'Access all category endpoints'
    ]
]);
