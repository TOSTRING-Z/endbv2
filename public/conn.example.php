<?php
/**
 * Safe database connection example for ENdb 2.0.
 *
 * Copy this file to public/conn.php for local deployment. The real conn.php is
 * ignored by Git. Supply all credentials through the web-server environment.
 */

$host = getenv('ENDB_DB_HOST');
$portValue = getenv('ENDB_DB_PORT');
$user = getenv('ENDB_DB_USER');
$password = getenv('ENDB_DB_PASSWORD');
$database = getenv('ENDB_DB_NAME');

$missing = [];
foreach ([
    'ENDB_DB_HOST' => $host,
    'ENDB_DB_USER' => $user,
    'ENDB_DB_PASSWORD' => $password,
    'ENDB_DB_NAME' => $database,
] as $name => $value) {
    if ($value === false) {
        $missing[] = $name;
    }
}

if ($missing) {
    throw new RuntimeException(
        'Missing required database environment variables: ' . implode(', ', $missing)
    );
}

$port = $portValue === false ? 3306 : (int) $portValue;
$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    throw new RuntimeException('Database connection failed');
}

mysqli_set_charset($conn, 'utf8mb4');
