<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Request_model');
        $this->load->model('Web_application_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

   public function index()
{
    // Cek login
    if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }

    // Hitung summary data untuk box kecil
    $data['total_request'] = $this->db->count_all('requests');
    $data['total_proses'] = $this->db->where('status', 'proses')->count_all_results('requests');
    $data['total_users'] = $this->db->count_all('users');
    $data['total_selesai'] = $this->db->where('status', 'selesai')->count_all_results('requests');

    // Ambil list user yang bisa jadi PIC (hanya untuk IT Manager)
    $data['users'] = ($this->session->userdata('role') == 'it_manager')
        ? $this->User_model->get_pic_users()
        : [];

    // Data session
    $data['role'] = $this->session->userdata('role');
    $data['username'] = $this->session->userdata('username');

    // Load view (pastikan file sesuai: application/views/dashboard/index.php)
    $this->load->view('dashboard/index', $data);
}


    public function create_user()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'it_manager') {
            redirect('dashboard');
        }

        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'password' => '12345' // auto password
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('success', 'User created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create user.');
            }
            redirect('users/create');
        }

        $data['role'] = $this->session->userdata('role');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('users/create', $data);
    }

    public function list_users()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'it_manager') {
            redirect('dashboard');
        }

        $data['users'] = $this->User_model->get_all_users();
        $data['role'] = $this->session->userdata('role');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('users/list', $data);
    }

    public function request()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $role = $this->session->userdata('role');
        $username = $this->session->userdata('username');
        if ($role == 'it_manager') {
            // Show list for approval
            $level = $this->input->get('level');
            if ($level) {
                $this->db->where('level', $level);
            }
            // Exclude rejected and approved requests from dashboard/request list for IT manager
            $this->db->where('status !=', 'rejected');
            $this->db->where('status !=', 'approved');
            $data['requests'] = $this->Request_model->get_all_requests();
            $data['level'] = $level;
            $data['role'] = $role;
            $data['username'] = $username;
            $data['users'] = $this->User_model->get_pic_users();
            $this->load->view('request_list', $data);
        } else {
            // Show form or list of own requests or assigned requests
            if ($this->input->post()) {
                $this->load->library('upload');
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|pdf|doc|docx';
                $config['max_size'] = 2048;
                if (!is_dir('./uploads/')) {
                    mkdir('./uploads/', 0755, true);
                }
                $this->upload->initialize($config);

                $file_path = NULL;
                if ($this->upload->do_upload('file_upload')) {
                    $upload_data = $this->upload->data();
                    $file_path = $upload_data['file_name'];
                }

                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'level' => $this->input->post('level'),
                    'application_id' => $this->input->post('application_id'),
                    'file_upload' => $file_path
                );
                if ($this->Request_model->create_request($data)) {
                    $this->session->set_flashdata('success', 'Request submitted successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to submit request.');
                }
                redirect('dashboard/request');
            }
            if ($role == 'internal') {
                // Show assigned requests for PIC (staff IT)
                $data['requests'] = $this->Request_model->get_requests_by_pic($this->session->userdata('user_id'));
            } else {
                // Show own requests for regular users
                $data['requests'] = $this->Request_model->get_requests_by_user($this->session->userdata('user_id'));
            }
            $data['applications'] = $this->Web_application_model->get_all_applications();
            $data['role'] = $role;
            $data['username'] = $username;
            $this->load->view('request', $data);
        }
    }

    public function approve_request($id)
    {
        if ($this->session->userdata('role') != 'it_manager') {
            redirect('dashboard');
        }

        if ($this->input->post()) {
            $status = $this->input->post('status');
            $pic_id = $this->input->post('pic_id');
            $rejection_reason = $this->input->post('rejection_reason');

            // If approved, set status to 'approved' and clear pic_id and rejection_reason
            if ($status === 'approved') {
                $status = 'approved';
                $pic_id = null; // ensure pic_id is null, not empty string
                $rejection_reason = null;
            }

            // If rejected, require rejection_reason
            if ($status === 'rejected' && empty($rejection_reason)) {
                $this->session->set_flashdata('error', 'Please provide a reason for rejection.');
                redirect('dashboard/request');
                return;
            }

            $update_data = array(
                'status' => $status,
                'pic_id' => $pic_id,
                'rejection_reason' => $rejection_reason
            );

            $update_result = $this->Request_model->update_request($id, $update_data);
            if ($update_result) {
                $this->session->set_flashdata('success', 'Request updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update request.');
            }
            redirect('dashboard/request'); // Redirect to dashboard/request after approval/rejection
        }
        redirect('dashboard/request');
    }

    public function approve_save($id)
    {
        if ($this->session->userdata('role') != 'it_manager') {
            redirect('dashboard');
        }

        if ($this->input->post()) {
            $pic_id = $this->input->post('pic_id');

            if (empty($pic_id)) {
                $this->session->set_flashdata('error', 'Please select a PIC.');
                redirect('dashboard/request');
                return;
            }

            $update_data = array(
                'status' => 'approved',
                'pic_id' => $pic_id,
                'rejection_reason' => null
            );

            $update_result = $this->Request_model->update_request($id, $update_data);
            if ($update_result) {
                $this->session->set_flashdata('success', 'Request approved and PIC assigned successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to approve request.');
            }
            redirect('pengerjaan');
        }
        redirect('dashboard/request');
    }
}
