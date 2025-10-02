<?php
$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
$result = $pdo->query("DESCRIBE requests");
$columns = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($columns as $col) {
    echo $col['Field'] . ' - ' . $col['Type'] . "\n";
}
