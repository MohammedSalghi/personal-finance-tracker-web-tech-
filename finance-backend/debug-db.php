<?php
// Debug script to check environment variables and connection
header("Content-Type: application/json");

// Load CORS configuration
require_once __DIR__ . '/config/cors.php';

try {
    // Check environment variables
    $env_vars = [
        'DATABASE_URL' => $_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL'),
        'DB_HOST' => $_ENV['DB_HOST'] ?? getenv('DB_HOST'),
        'DB_NAME' => $_ENV['DB_NAME'] ?? getenv('DB_NAME'),
        'DB_USER' => $_ENV['DB_USER'] ?? getenv('DB_USER'),
        'DB_PASSWORD' => $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ? '***HIDDEN***' : null,
        'DB_PORT' => $_ENV['DB_PORT'] ?? getenv('DB_PORT')
    ];
    
    $database_url = $env_vars['DATABASE_URL'];
    
    if ($database_url) {
        // Parse the DATABASE_URL
        $parsed = parse_url($database_url);
        $parsed_info = [
            'scheme' => $parsed['scheme'] ?? null,
            'host' => $parsed['host'] ?? null,
            'port' => $parsed['port'] ?? null,
            'path' => $parsed['path'] ?? null,
            'user' => $parsed['user'] ?? null,
            'pass' => $parsed['pass'] ? '***HIDDEN***' : null
        ];
        
        // Test connection
        $pdo_url = str_replace('postgresql://', 'pgsql://', $database_url);
        $pdo = new PDO($pdo_url, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        
        // Test query
        $stmt = $pdo->prepare("SELECT 1 as test");
        $stmt->execute();
        $result = $stmt->fetch();
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Database connection successful',
            'env_vars' => $env_vars,
            'parsed_url' => $parsed_info,
            'test_query' => $result,
            'timestamp' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT);
        
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No DATABASE_URL found',
            'env_vars' => $env_vars,
            'timestamp' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed',
        'error' => $e->getMessage(),
        'env_vars' => $env_vars ?? [],
        'parsed_url' => $parsed_info ?? null,
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_PRETTY_PRINT);
}
?>
