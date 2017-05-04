<?php
class Administration extends CI_Controller {

	public function __construct() {

		parent::__construct();
	}

	public function index() {

		$data['title'] = 'Administrateur - Accueil';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function listUsers() {

		$data['title'] = 'Administrateur - Gestion des utilisateurs';

		$this->load->model('user_model');

		$data['listUsers'] = $this->user_model->get_all();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
	}

	public function listFunctions() {

		$data['title'] = 'Administrateur - Gestion des fonctions';

		$this->load->model('function_model');

		$data['listFunctions'] = $this->function_model->get_all();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/functions', $data);
		$this->load->view('templates/footer');
	}

	public function addUser() {

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('active', 'Actif', 'required');
		$this->form_validation->set_rules('lastname', 'Nom', 'required');
		$this->form_validation->set_rules('firstname', 'Prénom', 'required');
		$this->form_validation->set_rules('email', 'Email', 
											'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('admin', 'Statut', 'required');

		$data['title'] = 'Administrateur - Gestion des utilisateurs - Création';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/user', $data);
		$this->load->view('templates/footer');
	}

	public function addFunction() {

		$data['title'] = 'Administrateur - Gestion des fonctions - Création';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		$this->form_validation->set_rules('name', 'Nom', 'required');

		if($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/function', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('function_model');
			$this->function_model->add($this->input->post('name'), $this->input->post('active'));
			$this->session->set_flashdata('success', 'Fonction ajoutée !');
			redirect('admin/functions');
		}
	}

	public function addContact() {

		$data['title'] = 'Administrateur - Gestion de l\'annuaire - Création';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/contact', $data);
		$this->load->view('templates/footer');
	}

	public function editUser($id) {

		$data['title'] = 'Administrateur - Gestion des utilisateurs';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/user', $data);
		$this->load->view('templates/footer');
	}

	public function editFunction($id) {

		$data['title'] = 'Administrateur - Gestion des fonctions';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/function', $data);
		$this->load->view('templates/footer');
	}

	public function editContact($id) {

		$data['title'] = 'Administrateur - Gestion de l\'annuaire';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/contact', $data);
		$this->load->view('templates/footer');
	}

	public function setUserActivity($id, $bool) {

		$this->load->model('user_model');
		$this->user_model->set_active($id, $bool);
		redirect('admin/users');
	}

	public function setFunctionActivity($id, $bool) {

		$this->load->model('function_model');
		$this->function_model->set_active($id, $bool);
		redirect('admin/functions');
	}
}