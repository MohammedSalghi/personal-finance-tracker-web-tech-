<?php
// Simple index file to get basic functionality working
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Simple response
echo json_encode([
    'status' => 'running',
    'message' => 'Personal Finance Tracker API - Backend is running!',
    'version' => '1.0.0',
    'timestamp' => date('Y-m-d H:i:s')
]);
?>
