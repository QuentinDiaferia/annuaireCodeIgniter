<?php
class Client extends CI_Controller {

	public function __construct() {

		parent::__construct();
	}

	public function index() {

		$data['title'] = 'Client - Accueil';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('client/annuaire', $data);
		$this->load->view('templates/footer');
	}

	public function contact($id) {

		$data['title'] = 'Client - Gestion des utilisateurs';

		$this->load->model('contact_model');

		$data['contact'] = $this->contact_model->get_by_id($id);
		$data['contact']['functions'] = $this->contact_model->get_functions_of($id);

		if(!isset($data['contact']['active'])) {
			$this->session->set_flashdata('error', 'Contact inexistant !');
			redirect('annuaire');
		}
		else {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('client/contact', $data);
			$this->load->view('templates/footer');
		}
	}
}