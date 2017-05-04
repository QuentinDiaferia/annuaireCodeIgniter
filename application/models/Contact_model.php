<?php
class Contact_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function get_all() {

		$query = $this->db->order_by('name', 'ASC')
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_id($id) {

		$query = $this->db->where('id', $id)
							->get('contacts');

		return $query->row_array();
	}

	public function get_functions_of($id) {

		$query = $this->db->select('id_function')
							->where('id_contact', $id)
							->get('contacts_functions');

		$ids = array();

		foreach($query->result_array() as $row) {
			$ids[] = $row['id_function'];
		}

		return $ids;
	}

	public function add() {

		$newContact = array(
			'active' => $this->input->post('active'),
			'title' => $this->input->post('title'),
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'telephone' => $this->input->post('telephone'),
			'mobile' => $this->input->post('mobile'),
			'fax' => $this->input->post('fax'),
			'decisionmaker' => $this->input->post('decisionmaker'),
			'company' => $this->input->post('company'),
			'address' => $this->input->post('address'),
			'address2' => $this->input->post('address2'),
			'postcode' => $this->input->post('postcode'),
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'website' => $this->input->post('website'),
			'email' => $this->input->post('email'),
			'photo' => $this->input->post('photo'),
			'comment' => $this->input->post('comment'),
			'lastmodified' => date('Y-m-d'),
			'modifiedby' => $this->session->id
		);

		$this->db->insert('contacts', $newContact);
		$contactId = $this->db->insert_id();

		$contactFunctions = array();

		foreach($this->input->post('functions') as $function) {
			$contactFunctions[] = array(
				'id_contact' => $contactId,
				'id_function' => $function
			);
		}

		$this->db->insert_batch('contacts_functions', $contactFunctions);
	}

	public function edit() {


	}

	public function set_active($id, $bool) {


	}

	public function delete($id) {


	}
}