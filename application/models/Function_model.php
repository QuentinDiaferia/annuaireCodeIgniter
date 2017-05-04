<?php
class Function_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}


	public function get_all() {

		$query = $this->db->order_by('name', 'ASC')
							->get('functions');
		return $query->result_array();
	}

	public function set_active($id, $bool) {

		$this->db->set('active', $bool)
					->where('id', $id)
					->update('functions');
	}

	public function add($name, $active) {

		$data = array(
			'name' => $name,
			'active' => $active);

		$this->db->insert('functions', $data);
	}
}