<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Use environment variables for production, fallback to localhost for development
        $this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
        $this->db_name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? $_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL') ?? 'personal_finance_tracker';
        $this->username = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
        
        // Handle Render's DATABASE_URL format
        if (isset($_ENV['DATABASE_URL']) || getenv('DATABASE_URL')) {
            $this->parseDatabaseUrl($_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL'));
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
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
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