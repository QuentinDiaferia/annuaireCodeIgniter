<?php
class User_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function login($email, $pwd) {

		$query = $this->db->select('id, admin, lastname, firstname')
						->where('email', $email)
						->where('password', $pwd)
						->get('users');

		if($query->num_rows() != 1)
			return NULL;

		$this->session->set_userdata($query->row_array());
		return TRUE;
	}

	public function get_all() {

		$query = $this->db->select('id, firstname, lastname, active')
							->order_by('lastname', 'ASC')
							->get('users');
		
		return $query->result_array();
	}

	public function set_active($id, $bool) {

		$this->db->set('active', $bool)
					->where('id', $id)
					->update('users');
	}

	public function delete($id) {

		$this->db->where('id', $id)
					->delete('users');
	}

	private function hash_password($password) {

	   return password_hash($password, PASSWORD_BCRYPT);
	}
}