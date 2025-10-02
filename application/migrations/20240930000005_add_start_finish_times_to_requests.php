<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_start_finish_times_to_requests extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('requests', array(
            'start_time' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
                'after' => 'rejection_reason'
            ),
            'finish_time' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
                'after' => 'start_time'
            )
        ));
    }

    public function down() {
        $this->dbforge->drop_column('requests', 'start_time');
        $this->dbforge->drop_column('requests', 'finish_time');
    }
}
