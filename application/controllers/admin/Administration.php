<?php
require_once(APPPATH.'controllers/MainController.php');

class Administration extends MainController {

	public function __construct() {

		parent::__construct();
		if(!isset($this->session->admin) || !$this->session->admin) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_access_forbidden'));
			redirect('annuaire');
		}
	}

	public function index() {

		$this->lang->load('title');
		$data['title'] = $this->lang->line('title_admin_index');

		$this->loadView('admin/index', $data);
	}
}