<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); 
        }
    }

    public function index()
    {
        $role_filter = $this->input->get('role');
        if ($role_filter) {
            $data['users'] = $this->User_model->get_users_by_role($role_filter);
        } else {
            $data['users'] = $this->User_model->get_all_users();
        }
        $data['role_filter'] = $role_filter;
        $data['role'] = $this->session->userdata('role');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('users/list', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role'     => $this->input->post('role')
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('success', 'User berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan user');
            }
            redirect('user');
        }
    }

    public function update($id)
    {
        $data = [
            'username' => $this->input->post('username'),
            'email'    => $this->input->post('email'),
            'role'     => $this->input->post('role')
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->load->database();
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        $this->session->set_flashdata('success', 'User berhasil diupdate');
        redirect('user');
    }

    public function delete($id)
    {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('users');

        $this->session->set_flashdata('success', 'User berhasil dihapus');
        redirect('user');
    }
}
