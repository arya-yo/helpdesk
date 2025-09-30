<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_requests extends CI_Migration {

    public function up() {
        if (!$this->db->table_exists('requests')) {
            $this->db->query("CREATE TABLE requests (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                status ENUM('pending','in_progress','completed','rejected') DEFAULT 'pending',
                pic_id INT(11) UNSIGNED DEFAULT NULL,
                level ENUM('urgent','not urgent') DEFAULT NULL,
                application_id INT(11) UNSIGNED DEFAULT NULL,
                application_name VARCHAR(100) NOT NULL,
                application_type ENUM('lama','baru') NOT NULL,
                file_upload VARCHAR(255) DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                CONSTRAINT fk_pic FOREIGN KEY (pic_id) REFERENCES users(id) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
    }

    public function down() {
        $this->dbforge->drop_table('requests');
    }
}
