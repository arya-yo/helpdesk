<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

    public function up()
    {
        if (!$this->db->table_exists('users')) {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => TRUE,
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '150',
                    'null' => TRUE,
                ),
                'role' => array(
                    'type' => 'ENUM',
                    'constraint' => "'it_manager','internal','external'",
                ),
                'created_at' => array(
                    'type' => 'TIMESTAMP',
                    'default' => 'CURRENT_TIMESTAMP',
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('users');
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
