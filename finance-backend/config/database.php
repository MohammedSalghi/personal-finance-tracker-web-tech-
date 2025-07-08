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
                // For PostgreSQL, use the full DATABASE_URL with proper format
                // Convert postgresql:// to pgsql://
                $pdo_url = str_replace('postgresql://', 'pgsql://', $database_url);
                $this->conn = new PDO($pdo_url, null, null, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } else {
                // Use individual environment variables for PostgreSQL
                $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? '5432';
                $this->conn = new PDO(
                    "pgsql:host=" . $this->host . ";port=" . $port . ";dbname=" . $this->db_name,
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
            error_log("Database connection error: " . $exception->getMessage());
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => 'Database connection failed',
                'details' => $exception->getMessage()
            ]);
            exit();
        }
        
        return $this->conn;
    }
}
?>