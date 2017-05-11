<?php
class User_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    public function login($email, $pwd) {

        $query = $this->db->select('id, password, admin, lastname, firstname')
                        ->where('email', $email)
                        ->get('users');

        if($query->num_rows() == 1 && password_verify($pwd, $query->row_array()['password'])) {
            $this->session->set_userdata($query->row_array());
            return true;
        }
        else {
            return false;
        }
    }

    public function get_all($direction = 'ASC') {

        $query = $this->db->select('id, firstname, lastname, active')
                            ->order_by('lastname', $direction)
                            ->order_by('firstname', $direction)
                            ->get('users');

        return $query->result_array();
    }

    public function get_by_id($id) {

        $query = $this->db->where('id', $id)
                            ->get('users');

        return $query->row_array();
    }

    public function add($data) {

        $this->db->insert('users', $data);
    }

    public function edit($id, $data) {

        $this->db->where('id', $id)->update('users', $data);
    }

    public function set_active($id, $bool) {

        $this->db->set('active', $bool)
                    ->where('id', $id)
                    ->update('users');

        return $this->db->affected_rows();
    }

    public function delete($id) {

        $this->db->where('id', $id)
                    ->delete('users');

        return $this->db->affected_rows();
    }

    public function email_unique($id, $email) {

        if($this->db->where('email', $email)
                    ->where('id !=', $id)
                    ->from('users')
                    ->count_all_results() == 0)
            return true;
        else
            return false;
    }
}