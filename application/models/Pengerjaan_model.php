<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengerjaan_model extends CI_Model {

    // Ambil semua request yang sudah di-assign (status approved, in_progress or completed)
    public function get_all_requests() {
        $this->db->select('r.*, u.username, p.username as pic_name');
        $this->db->from('requests r');
        $this->db->join('users u', 'u.id = r.user_id', 'left');  // pemohon
        $this->db->join('users p', 'p.id = r.pic_id', 'left');   // PIC
        $this->db->where_in('r.status', ['approved', 'in_progress', 'completed']);
        $this->db->order_by('r.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Mulai pengerjaan (ubah status jadi in_progress, set start_time)
    public function start_request($id, $pic_id) {
        $this->db->where('id', $id);
        return $this->db->update('requests', [
            'status' => 'in_progress',
            'pic_id' => $pic_id,
            'start_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Selesaikan pengerjaan (ubah status jadi completed, set finish_time)
    public function complete_request($id) {
        $this->db->where('id', $id);
        return $this->db->update('requests', [
            'status' => 'completed',
            'finish_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Tolak pengerjaan (ubah status jadi rejected)
    public function reject_request($id) {
        $this->db->where('id', $id);
        return $this->db->update('requests', [
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Cek 1 request by ID
    public function get_by_id($id) {
        $this->db->select('r.*, u.username, p.username as pic_name');
        $this->db->from('requests r');
        $this->db->join('users u', 'u.id = r.user_id', 'left');
        $this->db->join('users p', 'p.id = r.pic_id', 'left');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    // Ambil request berdasarkan PIC (staff IT)
    public function get_requests_by_pic($pic_id) {
        $this->db->select('r.*, u.username, p.username as pic_name');
        $this->db->from('requests r');
        $this->db->join('users u', 'u.id = r.user_id', 'left');  // pemohon
        $this->db->join('users p', 'p.id = r.pic_id', 'left');   // PIC
        $this->db->where('r.pic_id', $pic_id);
        $this->db->where_in('r.status', ['approved', 'in_progress', 'completed']);
        $this->db->order_by('r.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Start time tracking
    public function start_time($id) {
        $this->db->where('id', $id);
        return $this->db->update('requests', [
            'start_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // End time tracking
    public function end_time($id) {
        $this->db->where('id', $id);
        return $this->db->update('requests', [
            'end_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
