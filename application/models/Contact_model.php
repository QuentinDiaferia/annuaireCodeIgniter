<?php
class Contact_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function get_all() {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->from('contacts')
							->order_by('lastname')
							->get();

		return $query->result_array();
	}

	public function get_page($page) {

		$offset = ($page == 0) ? 0 : 10 * ($page - 1);
		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->from('contacts')
							->order_by('lastname', 'ASC')
							->limit(10, $offset)
							->get();

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

		$query = $this->db->select('id_function AS id, functions.name AS name')
							->from('contacts_functions')
							->join('functions', 'id_function = functions.id')
							->where('id_contact', $id)
							->get();

		return $query->result_array();
	}

	public function get_by_lastname($lastname) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('firstname')
							->where('lastname', $lastname)
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_firstname($firstname) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('lastname')
							->where('firstname', $firstname)
							->get('contacts');

		return $query->result_array();
	}

	public function get_by_initial($initial) {

		$query = $this->db->select('id, active, lastname, firstname, telephone, company')
							->order_by('lastname')
							->like('lastname', $initial, 'after')
							->get('contacts');

		return $query->result_array();
	}

	public function add($contact, $functions) {

		$this->db->insert('contacts', $contact);
		$contactId = $this->db->insert_id();

		$contactFunctions = array();

		foreach($functions as $function) {
			$contactFunctions[] = array(
				'id_contact' => $contactId,
				'id_function' => $function
			);
		}

		$this->db->insert_batch('contacts_functions', $contactFunctions);
	}

	public function edit($id, $contact, $functions) {

		$this->db->where('id', $id)->update('contacts', $contact);

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