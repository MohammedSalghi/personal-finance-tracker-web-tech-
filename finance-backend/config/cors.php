<?php
// CORS Configuration for Production Deployment
class CORSConfig {
    
    public static function setHeaders() {
        // Allow multiple origins for development and production
        $allowedOrigins = [
            'http://localhost:8080',
            'http://localhost:3000',
            'https://personal-finance-tracker-web-tech-vert.vercel.app',
            'https://personal-finance-tracker-web-tech.netlify.app',
            // Add your actual Netlify/Vercel URL here when deployed
        ];
        
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        
        if (in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            // Fallback for any https origin in production
            if (strpos($origin, 'https://') === 0) {
                header("Access-Control-Allow-Origin: $origin");
            }
        }
        
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 86400"); // 24 hours
        
        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit();
        }
    }
}
?>
