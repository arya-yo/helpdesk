<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        // tampilkan halaman login
        $this->load->view('login');
    }

    public function login()
    {
        $this->load->model('User_model');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validasi input tidak kosong
        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan password harus diisi!');
            redirect('auth');
            return;
        }

        log_message('info', 'Login attempt for username: ' . $username);

        $user = $this->User_model->login($username, $password);

        if ($user) {
            log_message('info', 'Login successful for: ' . $username);
            // simpan session
            $this->session->set_userdata([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'logged_in' => TRUE
            ]);
            redirect('dashboard');
        } else {
            log_message('info', 'Login failed for: ' . $username);
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
