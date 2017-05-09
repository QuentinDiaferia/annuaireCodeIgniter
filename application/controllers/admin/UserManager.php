<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class UserManager extends Administration {

	public function __construct() {

		parent::__construct();
		if(!isset($this->session->admin) || !$this->session->admin) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_access_forbidden'));
			redirect('annuaire');
		}
	}

	public function listUsers() {

		$this->lang->load('title');
		$data['title'] = $this->lang->line('title_admin_user');

		$this->load->model('user_model');

		$data['listUsers'] = $this->user_model->get_all();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
	}

	public function addUser() {

		$this->lang->load(array('title', 'forms'));
		$data['title'] = $this->lang->line('title_admin_user');

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules(
								'active', 
								$this->lang->line('label_active'), 
								'required|in_list[0,1]');

		$this->form_validation->set_rules(
								'title', 
								'Civilité', 
								'required|in_list[mle,mad,mon]');

		$this->form_validation->set_rules(
								'password', 
								$this->lang->line('label_password'), 
								'required');

		$this->form_validation->set_rules(
								'admin', 
								$this->lang->line('label_statut'),
								'required|in_list[0,1]');

		$this->form_validation->set_rules(
								'lastname', 
								$this->lang->line('label_lastname'),
								'required|strtoupper');

		$this->form_validation->set_rules(
								'firstname', 
								$this->lang->line('label_firstname'),
								'ucfirst');

		$this->form_validation->set_rules(
								'birthday', 
								$this->lang->line('label_birthday'),
								'callback_checkBirthDate');

		$this->form_validation->set_rules(
								'address', 
								$this->lang->line('label_address'),
								'required');

		$this->form_validation->set_rules(
								'postcode', 
								$this->lang->line('label_postcode'), 
								'required|integer|exact_length[5]');

		$this->form_validation->set_rules(
								'city', 
								$this->lang->line('label_city'), 
								'required');

		$this->form_validation->set_rules(
								'country', 
								$this->lang->line('label_country'),
								'required');

		$this->form_validation->set_rules(
								'telephone', 
								$this->lang->line('label_telephone'),
								'required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'email', 
								$this->lang->line('label_email'), 
								'required|valid_email|is_unique[users.email]');

		if($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');
			$this->load->view('admin/user', $data);
			$this->load->view('templates/footer');
		}
		else {

			$this->load->model('user_model');
			$newUser = array(
				'active' => $this->input->post('active'),
				'title' => $this->input->post('title'),
				'password' => hash('sha256', $this->input->post('password')),
				'admin' => $this->input->post('admin'),
				'lastname' => $this->input->post('lastname'),
				'firstname' => $this->input->post('firstname'),
				'address' => $this->input->post('address'),
				'address2' => $this->input->post('address2'),
				'postcode' => $this->input->post('postcode'),
				'city' => $this->input->post('city'),
				'country' => $this->input->post('country'),
				'telephone' => $this->input->post('telephone'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email')
			);

			if($this->input->post('birthday') != null)
				$updatedUser['birthday'] = DateTime::createFromFormat('d/m/Y', $this->input->post('birthday'))->format('Y-m-d');
			else
				$updatedUser['birthday'] = null;
			
			$this->user_model->add($newUser);
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_user_added'));
			redirect('admin/users');
		}
	}

	public function editUser($id) {

		$this->lang->load('title');
		$data['title'] = $this->lang->line('title_admin_user');

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');

		$this->form_validation->set_rules(
								'active', 
								$this->lang->line('label_active'), 
								'required|in_list[0,1]');

		$this->form_validation->set_rules(
								'title', 
								'Civilité', 
								'required|in_list[mle,mad,mon]');

		$this->form_validation->set_rules(
								'password', 
								$this->lang->line('label_password'), 
								'required');

		$this->form_validation->set_rules(
								'admin', 
								$this->lang->line('label_statut'),
								'required|in_list[0,1]');

		$this->form_validation->set_rules(
								'lastname', 
								$this->lang->line('label_lastname'),
								'required|strtoupper');

		$this->form_validation->set_rules(
								'firstname', 
								$this->lang->line('label_firstname'),
								'ucfirst');

		$this->form_validation->set_rules(
								'birthday', 
								$this->lang->line('label_birthday'),
								'callback_checkBirthDate');

		$this->form_validation->set_rules(
								'address', 
								$this->lang->line('label_address'),
								'required');

		$this->form_validation->set_rules(
								'postcode', 
								$this->lang->line('label_postcode'), 
								'required|integer|exact_length[5]');

		$this->form_validation->set_rules(
								'city', 
								$this->lang->line('label_city'), 
								'required');

		$this->form_validation->set_rules(
								'country', 
								$this->lang->line('label_country'),
								'required');

		$this->form_validation->set_rules(
								'telephone', 
								$this->lang->line('label_telephone'),
								'required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'email', 
								$this->lang->line('label_email'),
								'required|valid_email|callback_checkEmail['.$id.']');

		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['user'] = $this->user_model->get_by_id($id);

			if(!isset($data['user']['active'])) {

				$this->lang->load('flash');
				$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_contact'));
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
			$updatedUser = array(
				'active' => $this->input->post('active'),
				'title' => $this->input->post('title'),
				'password' => hash('sha256', $this->input->post('password')),
				'admin' => $this->input->post('admin'),
				'lastname' => $this->input->post('lastname'),
				'firstname' => $this->input->post('firstname'),
				'address2' => $this->input->post('address2'),
				'postcode' => $this->input->post('postcode'),
				'city' => $this->input->post('city'),
				'country' => $this->input->post('country'),
				'telephone' => $this->input->post('telephone'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email')
			);

			if($this->input->post('birthday') != null)
				$updatedUser['birthday'] = DateTime::createFromFormat('d/m/Y', $this->input->post('birthday'))->format('Y-m-d');
			else
				$updatedUser['birthday'] = null;

			$this->user_model->edit($id, $updatedUser);
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_user_edited'));
			redirect('admin/users');
		}
	}

	public function setUserActivity($id, $bool) {

		$this->load->model('user_model');
		if($this->user_model->set_active($id, $bool) == 0) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_user'));
		}
		redirect('admin/users');
	}

	public function deleteUser($id) {

		$this->load->model('user_model');
		if($this->user_model->delete($id) == 0) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_user'));
		}
		else {
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_user_deleted'));
		}
		redirect('admin/users');
	}

	public function checkEmail($email, $id) {

		if(!$this->user_model->email_unique($id, $this->input->post('email'))) {

			$this->lang->load('error');
			$this->form_validation->set_message(
									'checkEmail', 
									$this->lang->line('error_email'));
			return false;
		}
		return true;
	}

	public function checkBirthDate($date) {

		if($date != null) {

			$date = DateTime::createFromFormat('d/m/Y', $date);
			if(!$date || $date > new DateTime('now') || $date < new DateTime('1900-01-01')) {
				
				$this->lang->load('error');
				$this->form_validation->set_message(
										'checkBirthDate', 
										$this->lang->line('error_birthday'));
				return false;
			}
		}
		return true;
	}
}