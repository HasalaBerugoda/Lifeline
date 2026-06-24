<?php
// Database configuration and connection helper

// Helper to load .env file
function loadEnv() {
    static $loaded = false;
    if ($loaded) return;

    $envPath = dirname(__DIR__) . '/.env';
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'/", $value, $matches)) {
                    $value = substr($value, 1, -1);
                }
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
    $loaded = true;
}

// Auto-run dotenv loading
loadEnv();

// Define APP_URL constant if not defined
if (!defined('APP_URL')) {
    define('APP_URL', $_ENV['APP_URL'] ?? 'http://localhost/LIFELINE');
}

function getDBConnection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $db   = $_ENV['DB_DATABASE'] ?? 'blood_bank_test';
    $user = $_ENV['DB_USERNAME'] ?? 'root';
    $pass = $_ENV['DB_PASSWORD'] ?? '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (\PDOException $e) {
        // If the database doesn't exist, we might be in the setup phase.
        // Let's try connecting to MySQL without a database to allow setup.php to create it.
        try {
            $tempDsn = "mysql:host=$host;charset=$charset";
            $tempPdo = new PDO($tempDsn, $user, $pass, $options);
            return $tempPdo;
        } catch (\PDOException $innerEx) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Database connection failed: ' . $innerEx->getMessage()
            ]);
            exit;
        }
    }
}

