<?php
// Simple script to create the transactions table
require_once 'finance-backend/config/database.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();
    
    // Create transactions table
    $sql = "CREATE TABLE IF NOT EXISTS transactions (
        id SERIAL PRIMARY KEY,
        type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
        amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
        category VARCHAR(50) NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
    echo "✅ Table 'transactions' created successfully!\n";
    
    // Test the table by inserting a sample record
    $testSql = "INSERT INTO transactions (type, amount, category, description, date) 
                VALUES ('income', 1000.00, 'salary', 'Test transaction', CURRENT_DATE)";
    
    $pdo->exec($testSql);
    echo "✅ Test record inserted successfully!\n";
    
    // Check if the table works
    $checkSql = "SELECT COUNT(*) as count FROM transactions";
    $result = $pdo->query($checkSql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    echo "✅ Table has {$row['count']} records!\n";
    echo "🎉 Database is ready! Your frontend should work now!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
