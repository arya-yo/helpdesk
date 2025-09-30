<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengerjaan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // load library session
        $this->load->library('session');

        // load model
        $this->load->model('Pengerjaan_model');

        // pastikan sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // simpan role dan user_id dari session
        $this->role    = $this->session->userdata('role');
        $this->user_id = $this->session->userdata('user_id');
    }

    // List data pengerjaan
    public function index() {
    if ($this->role != 'it_manager' && $this->role != 'internal') {
        show_error('Akses ditolak, kamu tidak punya hak akses ke halaman ini.');
    }

    $data['title'] = 'AMAZINK PEOPLE GROUP | Pengerjaan';
    $data['active_dashboard'] = '';
    $data['active_request']   = '';
    $data['active_users']     = '';
    $data['active_master']    = 'menu-open';
    $data['active_list']      = '';
    $data['active_create']    = '';
    $data['active_pengerjaan']= 'active';

    // ini penting biar header/sidebar nggak error
    $data['username'] = $this->session->userdata('username');
    $data['role']     = $this->session->userdata('role');

    $data['requests'] = $this->Pengerjaan_model->get_all_requests();

    $this->load->view('pengerjaan', $data);
}


    // Mulai pengerjaan
    public function start($id) {
        if ($this->Pengerjaan_model->start_request($id, $this->user_id)) {
            $this->session->set_flashdata('success', 'Pengerjaan dimulai.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memulai pengerjaan.');
        }
        redirect('pengerjaan');
    }

    // Selesaikan pengerjaan
    public function complete($id) {
        if ($this->Pengerjaan_model->complete_request($id)) {
            $this->session->set_flashdata('success', 'Pengerjaan selesai.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyelesaikan pengerjaan.');
        }
        redirect('pengerjaan');
    }

    // Tolak pengerjaan
    public function reject($id) {
        if ($this->Pengerjaan_model->reject_request($id)) {
            $this->session->set_flashdata('success', 'Request ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak request.');
        }
        redirect('pengerjaan');
    }
}
