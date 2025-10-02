<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_approved_to_requests_status extends CI_Migration {

    public function up() {
        $this->dbforge->modify_column('requests', array(
            'status' => array(
                'type' => 'ENUM',
                'constraint' => "'pending','in_progress','completed','rejected','approved'",
                'default' => 'pending'
            )
        ));
    }

    public function down() {
        $this->dbforge->modify_column('requests', array(
            'status' => array(
                'type' => 'ENUM',
                'constraint' => "'pending','in_progress','completed','rejected'",
                'default' => 'pending'
            )
        ));
    }
}
