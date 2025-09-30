<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

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

    // List tugas untuk staff IT
    public function index() {
        if ($this->role != 'internal') {
            show_error('Akses ditolak, kamu tidak punya hak akses ke halaman ini.');
        }

        $data['title'] = 'AMAZINK PEOPLE GROUP | Tugas';
        $data['active_dashboard'] = '';
        $data['active_request']   = '';
        $data['active_users']     = '';
        $data['active_master']    = '';
        $data['active_list']      = '';
        $data['active_create']    = '';
        $data['active_pengerjaan']= '';
        $data['active_tugas']     = 'active';

        // ini penting biar header/sidebar nggak error
        $data['username'] = $this->session->userdata('username');
        $data['role']     = $this->session->userdata('role');

        // Get requests assigned to this user
        $data['requests'] = $this->Pengerjaan_model->get_requests_by_pic($this->user_id);

        $this->load->view('tugas', $data);
    }

    // Mulai tugas
    public function start($id) {
        if ($this->role != 'internal') {
            show_error('Akses ditolak.');
        }

        $this->load->database();
        $this->db->where('id', $id);
        $this->db->where('pic_id', $this->user_id);
        $this->db->update('requests', [
            'start_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->set_flashdata('success', 'Tugas dimulai.');
        redirect('tugas');
    }

    // Selesaikan tugas
    public function end($id) {
        if ($this->role != 'internal') {
            show_error('Akses ditolak.');
        }

        $this->load->database();
        $this->db->where('id', $id);
        $this->db->where('pic_id', $this->user_id);
        $this->db->update('requests', [
            'end_time' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->set_flashdata('success', 'Tugas selesai.');
        redirect('tugas');
    }
}
