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

		$data['title'] = 'Administrateur - Gestion des utilisateurs - Création';

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		$this->form_validation->set_rules('title', 'Civilité', 'required|in_list[mle,mad,mon]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required');
		$this->form_validation->set_rules('admin', 'Statut', 'required|in_list[0,1]');
		$this->form_validation->set_rules('lastname', 'Nom', 'required|strtoupper');
		$this->form_validation->set_rules('firstname', 'Prénom', 'ucfirst');
		$this->form_validation->set_rules('address', 'Adresse', 'required');
		$this->form_validation->set_rules('postcode', 'Code postal', 
									'required|integer|exact_length[5]');
		$this->form_validation->set_rules('city', 'Ville', 'required');
		$this->form_validation->set_rules('country', 'pays', 'required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 
									'required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('email', 'Email', 
									'required|valid_email|is_unique[users.email]');

		if($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/user', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('user_model');
			$this->user_model->add();
			$this->session->set_flashdata('success', 'Utilisateur ajouté !');
			redirect('admin/users');
		}
	}

	public function addFunction() {

		$data['title'] = 'Administrateur - Gestion des fonctions - Création';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Nom', 'required');
		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		
		if($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/function', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('function_model');
			$this->function_model->add();
			$this->session->set_flashdata('success', 'Fonction ajoutée !');
			redirect('admin/functions');
		}
	}

	public function addContact() {

		$data['title'] = 'Administrateur - Gestion de l\'annuaire - Création';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		$this->form_validation->set_rules('title', 'Civilité', 'required|in_list[mle,mad,mon]');
		$this->form_validation->set_rules('lastname', 'Nom', 'required|strtoupper');
		$this->form_validation->set_rules('firstname', 'Prénom', 'required|ucfirst');
		$this->form_validation->set_rules('telephone', 'Téléphone', 
									'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('mobile', 'Mobile', 
									'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('fax', 'Fax', 
									'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('decisionmaker', 'Décideur', 'in_list[0,1]');
		$this->form_validation->set_rules('company', 'Société', 'required|ucfirst');
		$this->form_validation->set_rules('functions[]', 'Fonctions', 'required|integer');
		$this->form_validation->set_rules('postcode', 'Code postal', 
									'integer|exact_length[5]');
		$this->form_validation->set_rules('website', 'Web', 'valid_url');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');

		if($this->form_validation->run() == FALSE) {

			$this->load->database();
			$this->load->model('function_model');

			$data['functions'] = $this->function_model->get_all();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/contact', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('contact_model');
			$this->contact_model->add();
			$this->session->set_flashdata('success', 'Contact ajouté !');
			redirect('annuaire');
		}

	}

	public function editUser($id) {

		$data['title'] = 'Administrateur - Gestion des utilisateurs';

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');

		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		$this->form_validation->set_rules('title', 'Civilité', 'required|in_list[mle,mad,mon]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required');
		$this->form_validation->set_rules('admin', 'Statut', 'required|in_list[0,1]');
		$this->form_validation->set_rules('lastname', 'Nom', 'required|strtoupper');
		$this->form_validation->set_rules('firstname', 'Prénom', 'ucfirst');
		$this->form_validation->set_rules('address', 'Adresse', 'required');
		$this->form_validation->set_rules('postcode', 'Code postal', 
									'required|integer|exact_length[5]');
		$this->form_validation->set_rules('city', 'Ville', 'required');
		$this->form_validation->set_rules('country', 'pays', 'required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 
									'required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('email', 'Email', 
									'required|valid_email');

		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['user'] = $this->user_model->get_by_id($id);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/user', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('user_model');
			$this->user_model->edit($id);
			$this->session->set_flashdata('success', 'Utilisateur modifié !');
			redirect('admin/users');
		}

		
	}

	public function editFunction($id) {

		$data['title'] = 'Administrateur - Gestion des fonctions';

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('function_model');

		$this->form_validation->set_rules('name', 'Nom', 'required');
		$this->form_validation->set_rules('active', 'Actif', 'required|in_list[0,1]');
		
		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['function'] = $this->function_model->get_by_id($id);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/function', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('function_model');
			$this->function_model->edit($id);
			$this->session->set_flashdata('success', 'Fonction modifiée !');
			redirect('admin/functions');
		}
		
	}

	public function editContact($id) {

		$data['title'] = 'Administrateur - Gestion de l\'annuaire';

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('contact_model');
		$this->load->model('function_model');

		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['contact'] = $this->contact_model->get_by_id($id);
			$data['contact']['functions'] = $this->contact_model->get_functions_of($id);
			$data['functions'] = $this->function_model->get_all();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/contact', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('contact_model');
		}
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

	public function deleteUser($id) {

		$this->load->model('user_model');
		$this->user_model->delete($id);
		$this->session->set_flashdata('success', 'Utilisateur supprimé !');
		redirect('admin/users');
	}

	public function deleteContact($id) {

		$this->load->model('user_contact');
		$this->contact_model->delete($id);
		$this->session->set_flashdata('success', 'Contact supprimé !');
		redirect('admin/addUser');
	}
}