<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Use environment variables for production, fallback to localhost for development
        if (isset($_ENV['DATABASE_URL']) || getenv('DATABASE_URL')) {
            $this->parseDatabaseUrl($_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL'));
        } else {
            $this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
            $this->db_name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'personal_finance_tracker';
            $this->username = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
            $this->password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
        }
    }

    private function parseDatabaseUrl($url) {
        $parsed = parse_url($url);
        if ($parsed) {
            $this->host = $parsed['host'];
            $this->db_name = ltrim($parsed['path'], '/');
            $this->username = $parsed['user'];
            $this->password = $parsed['pass'];
        }
    }

    public function getConnection() {
        $this->conn = null;
        
        try {
            // Check if DATABASE_URL is available (Render PostgreSQL)
            $database_url = getenv('DATABASE_URL') ?: $_ENV['DATABASE_URL'] ?? null;
            
            if ($database_url) {
                // Parse DATABASE_URL manually for better error handling
                $parsed = parse_url($database_url);
                if ($parsed === false) {
                    throw new Exception("Invalid DATABASE_URL format");
                }
                
                $host = $parsed['host'] ?? 'localhost';
                $port = $parsed['port'] ?? 5432;
                $database = ltrim($parsed['path'], '/');
                $username = $parsed['user'] ?? '';
                $password = $parsed['pass'] ?? '';
                
                $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
                
                $this->conn = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_TIMEOUT => 30
                ]);
            } else {
                // Use individual environment variables for PostgreSQL
                $host = getenv('DB_HOST') ?: $_ENV['DB_HOST'] ?? $this->host;
                $port = getenv('DB_PORT') ?: $_ENV['DB_PORT'] ?? '5432';
                $database = getenv('DB_NAME') ?: $_ENV['DB_NAME'] ?? $this->db_name;
                $username = getenv('DB_USER') ?: $_ENV['DB_USER'] ?? $this->username;
                $password = getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'] ?? $this->password;
                
                $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
                
                $this->conn = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_TIMEOUT => 30
                ]);
            }
            
            // Test the connection
            $this->conn->exec("SELECT 1");
            
        } catch(Exception $exception) {
            error_log("Database connection error: " . $exception->getMessage());
            throw $exception;
        }
        
        return $this->conn;
    }
}
?>