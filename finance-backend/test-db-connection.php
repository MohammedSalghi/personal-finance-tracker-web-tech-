<?php
// Test Database Connection
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Testing Database Connection...\n";

// Load database config
require_once 'config/database.php';

try {
    $database = new Database();
    $db = $database->getConnection();
    
    echo "✅ Database connected successfully!\n";
    
    // Test if transactions table exists
    $query = "SELECT COUNT(*) FROM transactions";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    echo "✅ Transactions table exists with $count records\n";
    
    // Test connection details
    echo "Database info: " . print_r($db->getAttribute(PDO::ATTR_SERVER_INFO), true) . "\n";
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    
    // Debug info
    echo "Environment variables:\n";
    echo "DATABASE_URL: " . (getenv('DATABASE_URL') ? 'SET' : 'NOT SET') . "\n";
    echo "DB_HOST: " . (getenv('DB_HOST') ? getenv('DB_HOST') : 'NOT SET') . "\n";
    echo "DB_NAME: " . (getenv('DB_NAME') ? getenv('DB_NAME') : 'NOT SET') . "\n";
    echo "DB_USER: " . (getenv('DB_USER') ? getenv('DB_USER') : 'NOT SET') . "\n";
    echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? 'SET' : 'NOT SET') . "\n";
    echo "DB_PORT: " . (getenv('DB_PORT') ? getenv('DB_PORT') : 'NOT SET') . "\n";
}
?>
