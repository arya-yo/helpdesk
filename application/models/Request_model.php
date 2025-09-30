<?php
class Request_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create_request($data) {
        return $this->db->insert('requests', $data);
    }

    public function get_all_requests() {
        $this->db->select('requests.*, users.username as user_name, web_applications.name as app_name');
        $this->db->from('requests');
        $this->db->join('users', 'users.id = requests.user_id');
        $this->db->join('web_applications', 'web_applications.id = requests.application_id', 'left');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_requests_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('requests')->result_array();
    }

    public function update_request($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('requests', $data);
    }

    public function get_request($id) {
        return $this->db->get_where('requests', array('id' => $id))->row_array();
    }

    public function get_requests_by_status($status) {
        $this->db->select('requests.*, users.username as user_name, web_applications.name as app_name');
        $this->db->from('requests');
        $this->db->join('users', 'users.id = requests.user_id');
        $this->db->join('web_applications', 'web_applications.id = requests.application_id', 'left');
        $this->db->where('requests.status', $status);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }
}
