<?php
// API Router for Personal Finance Tracker Backend
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove query string from URI
$request_uri = parse_url($request_uri, PHP_URL_PATH);

// Basic health check
if ($request_uri === '/' || $request_uri === '/health' || isset($_GET['health'])) {
    echo json_encode([
        'status' => 'healthy',
        'timestamp' => date('Y-m-d H:i:s'),
        'message' => 'Personal Finance Tracker API is running',
        'version' => '1.0.0'
    ]);
    exit;
}

// Route API requests
if (strpos($request_uri, '/api/transactions/') === 0) {
    $endpoint = str_replace('/api/transactions/', '', $request_uri);
    
    switch ($endpoint) {
        case 'get.php':
        case '':
            if ($request_method === 'GET') {
                require_once __DIR__ . '/api/transactions/get.php';
            }
            break;
            
        case 'post.php':
            if ($request_method === 'POST') {
                require_once __DIR__ . '/api/transactions/post.php';
            }
            break;
            
        case 'delete_all.php':
            if ($request_method === 'DELETE') {
                require_once __DIR__ . '/api/transactions/delete_all.php';
            }
            break;
            
        case 'delete.php':
            if ($request_method === 'DELETE') {
                require_once __DIR__ . '/api/transactions/delete.php';
            }
            break;
            
        case 'put.php':
            if ($request_method === 'PUT') {
                require_once __DIR__ . '/api/transactions/put.php';
            }
            break;
            
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
            break;
    }
} else {
    // Default response for root access
    echo json_encode([
        'status' => 'running',
        'message' => 'Personal Finance Tracker API - Backend is running!',
        'version' => '1.0.0'
    ]);
}
?>
