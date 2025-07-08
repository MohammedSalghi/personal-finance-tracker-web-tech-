<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

echo json_encode([
    'status' => 'success',
    'message' => 'Simple test endpoint working',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion()
]);
?>
