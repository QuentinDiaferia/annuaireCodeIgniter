<?php
class Administration extends CI_Controller {

	public function __construct() {

		parent::__construct();
		if(!isset($this->session->admin) || !$this->session->admin) {
			$this->session->set_flashdata('error', 'Vous n\'avez pas le droit d\'accéder à cette page.');
			redirect('annuaire');
		}
	}

	public function index() {

		$data['title'] = 'Administrateur - Accueil';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}
}