<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // login user
    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // kalau password sudah di-hash
            if (password_verify($password, $user->password)) {
                return $user;
            }

            // fallback kalau masih plain text (sementara aja)
            if ($password === $user->password) {
                return $user;
            }
        }
        return false;
    }

    // ambil semua user
    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    // ambil user berdasarkan role
    public function get_users_by_role($role) {
        $this->db->where('role', $role);
        return $this->db->get('users')->result();
    }

    // ambil user berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // register user baru
    public function register($data) {
        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $data);
    }
}
