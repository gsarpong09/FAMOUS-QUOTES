<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit(0);
}


echo json_encode([
    "message" => "Welcome to the Famous Quotes API!",
    "routes" => [
        "/quotes/" => "Access all quote endpoints",
        "/authors/" => "Access all author endpoints",
        "/categories/" => "Access all category endpoints"
    ]
]);
