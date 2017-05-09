<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class UserManager extends Administration {

	public function __construct() {

		parent::__construct();
		if(!isset($this->session->admin) || !$this->session->admin) {
			$this->session->set_flashdata('error', 'Vous n\'avez pas le droit d\'accéder à cette page.');
			redirect('annuaire');
		}
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
		$this->form_validation->set_rules('birthday', 'Date de naissance', 'callback_checkBirthDate');
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
			$this->session->set_flashdata('success', 'Utilisateur ajouté.');
			redirect('admin/users');
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
		$this->form_validation->set_rules('birthday', 'Date de naissance', 'callback_checkBirthDate');
		$this->form_validation->set_rules('address', 'Adresse', 'required');
		$this->form_validation->set_rules('postcode', 'Code postal', 
									'required|integer|exact_length[5]');
		$this->form_validation->set_rules('city', 'Ville', 'required');
		$this->form_validation->set_rules('country', 'pays', 'required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 
									'required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');
		$this->form_validation->set_rules('email', 'Email', 
									'required|valid_email|callback_checkEmail['.$id.']');

		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['user'] = $this->user_model->get_by_id($id);

			if(!isset($data['user']['active'])) {

				$this->session->set_flashdata('error', 'Utilisateur inexistant.');
				redirect('admin/users');
			}
			else {
			
				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu');
				$this->load->view('admin/user', $data);
				$this->load->view('templates/footer');
			}
		}
		else {

			$this->load->model('user_model');
			$this->user_model->edit($id);
			$this->session->set_flashdata('success', 'Utilisateur modifié.');
			redirect('admin/users');
		}
	}

	public function setUserActivity($id, $bool) {

		$this->load->model('user_model');
		if($this->user_model->set_active($id, $bool) == 0)
			$this->session->set_flashdata('error', 'Utilisateur inexistant.');
		redirect('admin/users');
	}

	public function deleteUser($id) {

		$this->load->model('user_model');
		if($this->user_model->delete($id) == 0)
			$this->session->set_flashdata('error', 'Utilisateur inexistant.');
		else
			$this->session->set_flashdata('success', 'Utilisateur supprimé.');
		redirect('admin/users');
	}

	public function checkEmail($email, $id) {

		if(!$this->user_model->email_unique($id, $this->input->post('email'))) {
			$this->form_validation->set_message('checkEmail', 'Email utilisé par un autre utilisateur.');
			return false;
		}
		return true;
	}

	public function checkBirthDate($date) {

		$date = DateTime::createFromFormat('d/m/Y', $date);

		if(!$date || $date > new DateTime('now') || $date < new DateTime('1900-01-01')) {
			$this->form_validation->set_message('checkBirthDate', 'Date de naissance invalide.');
			return false;
		}
		return true;
	}
}