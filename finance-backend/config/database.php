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
            $database_url = $_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL');
            
            if ($database_url) {
                // Parse DATABASE_URL for PostgreSQL
                $this->conn = new PDO($database_url);
            } else {
                // Use individual environment variables for PostgreSQL
                $this->conn = new PDO(
                    "pgsql:host=" . $this->host . ";port=5432;dbname=" . $this->db_name,
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            }
        } catch(PDOException $exception) {
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => 'Database connection failed'
            ]);
            exit();
        }
        
        return $this->conn;
    }
}
?>