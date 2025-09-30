    <?php

    class Web_application_model extends CI_Model {

        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function get_all_applications() {
            return $this->db->get('web_applications')->result_array();
        }

        public function create_application($data) {
            return $this->db->insert('web_applications', $data);
        }

        // Add other methods if needed, like update, delete
    }
