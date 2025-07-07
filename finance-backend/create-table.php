<?php
// Create transactions table in the database
require_once 'config/database.php';

try {
    // Get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // SQL to create transactions table
    $sql = "CREATE TABLE IF NOT EXISTS transactions (
        id SERIAL PRIMARY KEY,
        type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
        amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
        category VARCHAR(50) NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Execute the query
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    
    if ($result) {
        echo "✅ SUCCESS: Transactions table created successfully!<br>";
        
        // Test with a sample insert
        $testSql = "INSERT INTO transactions (type, amount, category, description, date) 
                   VALUES ('income', 1000.00, 'salary', 'Test transaction', CURRENT_DATE)";
        $testStmt = $db->prepare($testSql);
        
        if ($testStmt->execute()) {
            echo "✅ SUCCESS: Test transaction inserted!<br>";
            
            // Count total transactions
            $countSql = "SELECT COUNT(*) as total FROM transactions";
            $countStmt = $db->prepare($countSql);
            $countStmt->execute();
            $count = $countStmt->fetch(PDO::FETCH_ASSOC);
            
            echo "📊 Total transactions in database: " . $count['total'] . "<br>";
            echo "🎉 Your database is ready! You can now use your finance app!";
        } else {
            echo "⚠️ Table created but test insert failed";
        }
        
    } else {
        echo "❌ ERROR: Failed to create table";
    }
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage();
}
?>
