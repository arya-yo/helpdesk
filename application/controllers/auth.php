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

        $user = $this->User_model->login($username, $password);
        
        if ($user) {
            // simpan session
            $this->session->set_userdata([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'logged_in' => TRUE
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth');
            $user = $this->User_model->login($username, $password);
            log_message('info', 'Login attempt for username: ' . $username . ', User found: ' . ($user ? 'yes' : 'no'));
            if ($user) {
                log_message('info', 'Password verify: ' . (password_verify($password, $user->password) ? 'yes' : 'no'));
                // ... rest of code
}

        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
