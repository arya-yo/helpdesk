<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_rejection_reason_to_requests extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('requests', array(
            'rejection_reason' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'file_upload'
            )
        ));
    }

    public function down() {
        $this->dbforge->drop_column('requests', 'rejection_reason');
    }
}
