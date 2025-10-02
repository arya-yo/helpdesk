<?php
require 'application/config/database.php';
$pdo = new PDO('mysql:host=' . $db['default']['hostname'] . ';dbname=' . $db['default']['database'], $db['default']['username'], $db['default']['password']);
$result = $pdo->query("DESCRIBE requests");
$columns = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($columns as $col) {
    echo $col['Field'] . ' - ' . $col['Type'] . "\n";
}
