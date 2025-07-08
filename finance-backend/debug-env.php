<?php
// Debug environment variables
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'DATABASE_URL' => getenv('DATABASE_URL') ? 'SET' : 'NOT SET',
    'DB_HOST' => getenv('DB_HOST') ?: 'NOT SET',
    'DB_NAME' => getenv('DB_NAME') ?: 'NOT SET', 
    'DB_USER' => getenv('DB_USER') ?: 'NOT SET',
    'DB_PASSWORD' => getenv('DB_PASSWORD') ? 'SET' : 'NOT SET',
    'DB_PORT' => getenv('DB_PORT') ?: 'NOT SET',
    'PHP_VERSION' => phpversion(),
    'PDO_AVAILABLE' => extension_loaded('pdo') ? 'YES' : 'NO',
    'PDO_PGSQL_AVAILABLE' => extension_loaded('pdo_pgsql') ? 'YES' : 'NO'
]);
?>
