<?php
define('BASEPATH', dirname(__FILE__) . '/system/');
require_once 'index.php';

$CI =& get_instance();
$CI->load->database();
$CI->load->model('User_model');

$data = [
    'username' => 'admin',
    'password' => password_hash('12345', PASSWORD_DEFAULT),
    'email' => 'admin@example.com',
    'role' => 'it_manager'
];

if ($CI->User_model->register($data)) {
    echo "User created successfully.";
} else {
    echo "Failed to create user.";
}
?>
