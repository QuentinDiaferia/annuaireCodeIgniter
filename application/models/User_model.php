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
	private $postalcode;
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

	public function add() {

		$data['active'] = $this->input->post('active');
		$data['title'] = $this->input->post('title');
		$data['password'] = hash('sha256', $this->input->post('password'));
		$data['admin'] = $this->input->post('admin');
		$data['lastname'] = $this->input->post('lastname');
		$data['firstname'] = $this->input->post('firstname');
		$data['birthday'] = $this->input->post('birthday');
		$data['address'] = $this->input->post('address');
		$data['address2'] = $this->input->post('address2');
		$data['postalcode'] = $this->input->post('postalcode');
		$data['city'] = $this->input->post('city');
		$data['country'] = $this->input->post('country');
		$data['telephone'] = $this->input->post('telephone');
		$data['mobile'] = $this->input->post('mobile');
		$data['email'] = $this->input->post('email');

		$this->db->insert('users', $data);
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