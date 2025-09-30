<?php
$host = 'localhost';
$db = 'helpdesk';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create migrations table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        version BIGINT(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

    // Insert users migration version
    $stmt = $pdo->prepare("INSERT INTO migrations (version) VALUES (?) ON DUPLICATE KEY UPDATE version = version");
    $stmt->execute(['20240929000000']);

    echo "Migrations table bootstrapped with users migration marked as run.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
