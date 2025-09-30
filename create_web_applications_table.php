<?php
$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
$pdo->exec("CREATE TABLE web_applications (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
echo 'web_applications table created.';
