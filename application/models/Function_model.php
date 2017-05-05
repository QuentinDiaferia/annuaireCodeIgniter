<?php
class Function_model extends CI_Model {

	private $id;
	private $name;
	private $active;

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}


	public function get_all() {

		$query = $this->db->order_by('name', 'ASC')
							->get('functions');

		return $query->result_array();
	}

	public function get_by_id($id) {

		$query = $this->db->where('id', $id)
							->get('functions');

		return $query->row_array();
	}

	public function get_existing_ids() {

		$query = $this->db->select('id')
							->get('functions');

		$ids = array();

		foreach($query->result_array() as $row) {
			$ids[] = $row['id'];
		}

		return $ids;
	}

	public function add() {

		$newFunction = array(
			'name' => $this->input->post('name'),
			'active' => $this->input->post('active')
		);

		$this->db->insert('functions', $newFunction);
	}

	public function edit($id) {

		$updatedFunction = array(
			'name' => $this->input->post('name'),
			'active' => $this->input->post('active')
		);

		$this->db->where('id', $id)->update('functions', $updatedFunction);
	}

	public function set_active($id, $bool) {

		$this->db->set('active', $bool)
					->where('id', $id)
					->update('functions');

		return $this->db->affected_rows();
	}
}