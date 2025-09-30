<?php
$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
$pdo->exec('INSERT INTO migrations (version) VALUES (20240930000000) ON DUPLICATE KEY UPDATE version = version');
$pdo->exec('INSERT INTO migrations (version) VALUES (20240930000001) ON DUPLICATE KEY UPDATE version = version');
echo 'Migrations marked as run.';
