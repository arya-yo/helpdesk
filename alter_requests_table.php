<?php
$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
$pdo->exec("ALTER TABLE requests ADD COLUMN application_id INT(11) UNSIGNED DEFAULT NULL");
$pdo->exec("ALTER TABLE requests ADD COLUMN application_name VARCHAR(100) NOT NULL DEFAULT ''");
$pdo->exec("ALTER TABLE requests ADD COLUMN application_type ENUM('lama','baru') DEFAULT NULL");
$pdo->exec("ALTER TABLE requests ADD COLUMN file_upload VARCHAR(255) DEFAULT NULL");
echo 'requests table altered.';
