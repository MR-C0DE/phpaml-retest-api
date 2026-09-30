<?php

declare(strict_types=1);

$path = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
header('Content-Type: application/json; charset=UTF-8');

$routes = [
    '/' => ['service' => 'phpaml-retest-api', 'status' => 'online'],
    '/api/health' => ['service' => 'phpaml-retest-api', 'status' => 'ok'],
    '/api/version' => ['runtime' => 'PHP', 'version' => PHP_VERSION],
];

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    echo json_encode(['error' => 'not_found'], JSON_THROW_ON_ERROR);
    exit;
}

echo json_encode($routes[$path], JSON_THROW_ON_ERROR);
