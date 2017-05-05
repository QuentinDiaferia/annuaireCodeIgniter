<?php
class Client extends CI_Controller {

	public function __construct() {

		parent::__construct();
		if(!isset($this->session->admin)) {
			$this->session->set_flashdata('error', 'Vous n\'avez pas le droit d\'accéder à cette page.');
			redirect('connexion');
		}
	}

	public function index() {

		$data['title'] = 'Client - Accueil';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('client/annuaire', $data);
		$this->load->view('templates/footer');
	}

	public function annuaire($filter = null, $initial = null) {

		$data['title'] = 'Annuaire';

		$this->load->helper('form');
		$this->load->model('contact_model');

		switch($filter) {

			case 'initial':
				$data['listContacts'] = $this->contact_model->get_by_initial($initial);
				break;

			case 'lastname':
				$data['listContacts'] = $this->contact_model->get_by_lastname($this->input->post('lastname'));
				break;

			case 'firstname':
				$data['listContacts'] = $this->contact_model->get_by_firstname($this->input->post('firstname'));
				break;

			default:
				$data['listContacts'] = $this->contact_model->get_all();
				break;
		}

		$data['nbContacts'] = $this->contact_model->count();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('annuaire', $data);
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