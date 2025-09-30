<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_application extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Web_application_model');
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'it_manager') {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['applications'] = $this->Web_application_model->get_all_applications();
        $data['role'] = $this->session->userdata('role');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('web_applications/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name')
            ];

            if ($this->Web_application_model->create_application($data)) {
                $this->session->set_flashdata('success', 'Web Application added successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to add web application.');
            }
        }
        redirect('web_application'); // balik ke list
    }
    public function update($id)
    {
    $name = $this->input->post('name');
    $this->db->where('id', $id);
    $this->db->update('web_applications', [
        'name' => $name
    ]);

    $this->session->set_flashdata('success', 'Data berhasil diupdate');
    redirect('web_application');
    }   

    public function delete($id)
    {
    $this->db->where('id', $id);
    $this->db->delete('web_applications');

    $this->session->set_flashdata('success', 'Data berhasil dihapus');
    redirect('web_application');
    }

}
