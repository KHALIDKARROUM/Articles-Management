<?php


$config = [
    'host' => 'localhost',
    'dbname' => 'gestion_articles_scientifiques',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4'
];

try {
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['user'], $config['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    error_log("[" . date('Y-m-d H:i:s') . "] DB Error: " . $e->getMessage());
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die("Maintenance en cours. Veuillez réessayer ultérieurement.");
}

