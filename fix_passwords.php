<?php
/**
 * Script untuk memperbaiki password user di database
 * Script ini akan mengubah semua password plain text menjadi hashed password
 */

// Load CodeIgniter
require_once('index.php');

// Get CI instance
$CI =& get_instance();
$CI->load->database();

echo "=== Fix User Passwords ===\n\n";

// Get all users
$query = $CI->db->get('users');
$users = $query->result();

echo "Total users found: " . count($users) . "\n\n";

foreach ($users as $user) {
    echo "Checking user: " . $user->username . " (ID: " . $user->id . ")\n";
    
    // Check if password is already hashed (bcrypt starts with $2y$)
    if (substr($user->password, 0, 4) === '$2y$') {
        echo "  -> Password already hashed, skipping\n\n";
        continue;
    }
    
    // Password is plain text, hash it
    $plain_password = $user->password;
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
    
    // Update database
    $CI->db->where('id', $user->id);
    $CI->db->update('users', ['password' => $hashed_password]);
    
    echo "  -> Plain password: " . $plain_password . "\n";
    echo "  -> Hashed successfully!\n\n";
}

echo "=== Done! ===\n";
echo "\nAll passwords have been checked and updated if needed.\n";
echo "Users can now login with their original passwords.\n";