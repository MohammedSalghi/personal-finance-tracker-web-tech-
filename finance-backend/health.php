<?php
// Load CORS configuration
require_once __DIR__ . '/config/cors.php';

header("Content-Type: application/json");

try {
    // Check database connection
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    
    // Test query
    $query = "SELECT 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    // Response
    http_response_code(200);
    echo json_encode([
        "status" => "healthy",
        "message" => "Backend API is running",
        "database" => "connected",
        "timestamp" => date("Y-m-d H:i:s"),
        "version" => "1.0.0"
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Health check failed",
        "error" => $e->getMessage(),
        "timestamp" => date("Y-m-d H:i:s")
    ]);
}
?>
