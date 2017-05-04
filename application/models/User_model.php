<?php
class User_model extends CI_Model {

	private $id;
	private $active;
	private $title;
	private $password;
	private $admin;
	private $lastname;
	private $firstname;
	private $birthday;
	private $address;
	private $address2;
	private $postcode;
	private $city;
	private $country;
	private $telephone;
	private $mobile;
	private $email;


	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function login($email, $pwd) {

		$query = $this->db->select('id, admin, lastname, firstname')
						->where('email', $email)
						->where('password', hash('sha256', $pwd))
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

	public function get_by_id($id) {

		$query = $this->db->where('id', $id)
							->get('users');

		return $query->row_array();
	}

	public function add() {

		$newUser = array(
			'active' => $this->input->post('active'),
			'title' => $this->input->post('title'),
			'password' => hash('sha256', $this->input->post('password')),
			'admin' => $this->input->post('admin'),
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'birthday' => $this->input->post('birthday'),
			'address' => $this->input->post('address'),
			'address2' => $this->input->post('address2'),
			'postcode' => $this->input->post('postcode'),
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'telephone' => $this->input->post('telephone'),
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('email')
		);

		$this->db->insert('users', $newUser);
	}

	public function edit($id) {

		$updatedUser = array(
			'active' => $this->input->post('active'),
			'title' => $this->input->post('title'),
			'password' => hash('sha256', $this->input->post('password')),
			'admin' => $this->input->post('admin'),
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'birthday' => $this->input->post('birthday'),
			'address' => $this->input->post('address'),
			'address2' => $this->input->post('address2'),
			'postcode' => $this->input->post('postcode'),
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'telephone' => $this->input->post('telephone'),
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('email')
		);

		$this->db->where('id', $id)->update('users', $updatedUser);
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
}