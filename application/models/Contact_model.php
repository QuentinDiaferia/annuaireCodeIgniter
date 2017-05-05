<?php
class Contact_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function get_all() {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('lastname', 'ASC')
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_id($id) {

		$query = $this->db->select('contacts.*, DATE_FORMAT(lastmodified, "%d/%m/%Y") as date, users.lastname as u_lastname, users.firstname as u_firstname')
							->from('contacts')
							->join('users', 'users.id = contacts.modifiedby')
							->where('contacts.id', $id)
							->get();

		return $query->row_array();
	}

	public function get_functions_of($id) {

		$query = $this->db->select('id_function, functions.name')
							->from('contacts_functions')
							->join('functions', 'id_function = functions.id')
							->where('id_contact', $id)
							->get();

		$functions = array();

		foreach($query->result_array() as $row) {

			$functions[] = array(
				'id' => $row['id_function'],
				'name' => $row['name'],
			);
		}

		return $functions;
	}

	public function get_by_lastname($lastname) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('firstname', 'ASC')
							->where('lastname', $lastname)
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_firstname($firstname) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('lastname', 'ASC')
							->where('firstname', $firstname)
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_initial($initial) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('lastname', 'ASC')
							->like('lastname', $initial, 'after')
							->get('contacts');

		return $query->result_array();
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
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'website' => $this->input->post('website'),
			'email' => $this->input->post('email'),
			'photo' => $this->input->post('photo'),
			'comment' => $this->input->post('comment'),
			'lastmodified' => date('Y-m-d'),
			'modifiedby' => $this->session->id
		);

		if($this->input->post('postcode') == '')
			$updatedContact['postcode'] = null;
		else
			$updatedContact['postcode'] = $this->input->post('postcode');

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

	public function edit($id) {

		$updatedContact = array(
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
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'website' => $this->input->post('website'),
			'email' => $this->input->post('email'),
			'photo' => $this->input->post('photo'),
			'comment' => $this->input->post('comment'),
			'lastmodified' => date('Y-m-d'),
			'modifiedby' => $this->session->id
		);

		if($this->input->post('postcode') == '')
			$updatedContact['postcode'] = null;
		else
			$updatedContact['postcode'] = $this->input->post('postcode');

		$this->db->where('id', $id)->update('contacts', $updatedContact);

		$newContactFunctions = array();

		foreach($this->input->post('functions') as $function) {
			$newContactFunctions[] = array(
				'id_contact' => $id,
				'id_function' => $function
			);
		}

		$this->db->where('id_contact', $id)
					->delete('contacts_functions');
		$this->db->insert_batch('contacts_functions', $newContactFunctions);
	}

	public function set_active($id, $bool) {

		$this->db->set('active', $bool)
					->where('id', $id)
					->update('contacts');

		return $this->db->affected_rows();
	}

	public function delete($id) {

		$this->db->where('id_contact', $id)
					->delete('contacts_functions');

		$affectedRows = $this->db->affected_rows();

		if($affectedRows != 0) {
			$this->db->where('id', $id)
					->delete('contacts');
		}

		return $affectedRows;
	}

	public function count() {

		return $this->db->count_all('contacts');
	}
}