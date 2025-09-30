<?php
$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
$pdo->exec('DELETE FROM migrations WHERE version IN (20240930000000, 20240930000001)');
echo 'Migration entries deleted.';
