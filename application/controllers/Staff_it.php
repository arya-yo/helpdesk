<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_it extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Request_model');
        $this->load->model('User_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') != 'it_manager') {
            show_error('Akses ditolak, hanya IT Manager yang dapat mengakses halaman ini.');
        }

        $this->role = $this->session->userdata('role');
        $this->user_id = $this->session->userdata('user_id');
    }

    public function index() {
        $data['title'] = 'Lempar Request ke Staff IT';
        $data['active_master'] = 'menu-open';
        $data['active_staff_it'] = 'active';
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');

        // Get approved requests (status = 'pending', assuming approved)
        $data['requests'] = $this->Request_model->get_requests_by_status('pending');
        $data['staff_it_users'] = $this->User_model->get_users_by_role('internal');

        $this->load->view('staff_it/index', $data);
    }

    public function assign($request_id) {
        $pic_id = $this->input->post('pic_id');
        $level = $this->input->post('level');

        if ($this->Request_model->update_request($request_id, [
            'pic_id' => $pic_id,
            'level' => $level,
            'status' => 'in_progress',
            'updated_at' => date('Y-m-d H:i:s')
        ])) {
            $this->session->set_flashdata('success', 'Request berhasil dilempar ke Staff IT.');
        } else {
            $this->session->set_flashdata('error', 'Gagal melempar request.');
        }
        redirect('staff_it');
    }
}
