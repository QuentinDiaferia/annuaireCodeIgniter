<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class ContactManager extends Administration {

	public function __construct() {

		parent::__construct();
	}

	public function addContact() {

		$this->lang->load(array('title', 'forms'));
		$data['title'] = $this->lang->line('title_admin_contact');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
								'active', 
								$this->lang->line('label_active'), 
								'required|in_list[0,1]|callback_checkExistingFunctions');

		$this->form_validation->set_rules(
								'title', 
								$this->lang->line('label_title'),
								'required|in_list[mle,mad,mon]');

		$this->form_validation->set_rules(
								'lastname', 
								$this->lang->line('label_lastname'),  
								'required|strtoupper');

		$this->form_validation->set_rules(
								'firstname', 
								$this->lang->line('label_firstname'), 
								'required|ucfirst');

		$this->form_validation->set_rules(
								'telephone', 
								$this->lang->line('label_telephone'),  
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'mobile', 
								$this->lang->line('label_mobile'), 
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'fax', 
								$this->lang->line('label_fax'), 
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'decisionmaker', 
								$this->lang->line('label_decisionmaker'),  
								'in_list[0,1]');

		$this->form_validation->set_rules(
								'company', 
								$this->lang->line('label_company'), 
								'required|ucfirst');

		$this->form_validation->set_rules(
								'functions[]', 
								$this->lang->line('label_functions'),  
								'required|integer');

		$this->form_validation->set_rules(
								'postcode', 
								$this->lang->line('label_postcode'), 
								'integer|exact_length[5]');

		$this->form_validation->set_rules(
								'website', 
								$this->lang->line('label_website'),  
								'valid_url');

		$this->form_validation->set_rules(
								'email', 
								$this->lang->line('label_email'),  
								'valid_email');

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

			$newContact = array(
				'active' => $this->input->post('active'),
				'title' => $this->input->post('title'),
				'lastname' => $this->input->post('lastname'),
				'firstname' => $this->input->post('firstname'),
				'telephone' => $this->input->post('telephone'),
				'mobile' => $this->input->post('mobile'),
				'fax' => $this->input->post('fax'),
				'decisionmaker' => $this->input->post('decisionmaker'),
				'company' => $this->input->post('company'),
				'address' => $this->input->post('address'),
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'country' => $this->input->post('country'),
				'website' => $this->input->post('website'),
				'email' => $this->input->post('email'),
				'photo' => $this->input->post('photo'),
				'comment' => $this->input->post('comment'),
				'lastmodified' => date('Y-m-d'),
				'modifiedby' => $this->session->id
			);

			if($this->input->post('postcode') == '')
				$newContact['postcode'] = null;
			else
				$newContact['postcode'] = $this->input->post('postcode');

			$this->contact_model->add($newContact, $this->input->post('functions'));
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_contact_added'));
			redirect('annuaire');
		}
	}

	public function editContact($id) {

		$this->lang->load(array('title', 'forms'));
		$data['title'] = $this->lang->line('title_admin_contact');

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('contact_model');
		$this->load->model('function_model');

		$this->form_validation->set_rules(
								'active', 
								$this->lang->line('label_active'), 
								'required|in_list[0,1]|callback_checkExistingFunctions');

		$this->form_validation->set_rules(
								'title', 
								$this->lang->line('label_title'),
								'required|in_list[mle,mad,mon]');

		$this->form_validation->set_rules(
								'lastname', 
								$this->lang->line('label_lastname'),  
								'required|strtoupper');

		$this->form_validation->set_rules(
								'firstname', 
								$this->lang->line('label_firstname'), 
								'required|ucfirst');

		$this->form_validation->set_rules(
								'telephone', 
								$this->lang->line('label_telephone'),  
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'mobile', 
								$this->lang->line('label_mobile'), 
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'fax', 
								$this->lang->line('label_fax'), 
								'regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

		$this->form_validation->set_rules(
								'decisionmaker', 
								$this->lang->line('label_decisionmaker'),  
								'in_list[0,1]');

		$this->form_validation->set_rules(
								'company', 
								$this->lang->line('label_company'), 
								'required|ucfirst');

		$this->form_validation->set_rules(
								'functions[]', 
								$this->lang->line('label_functions'),  
								'required|integer');

		$this->form_validation->set_rules(
								'postcode', 
								$this->lang->line('label_postcode'), 
								'integer|exact_length[5]');

		$this->form_validation->set_rules(
								'website', 
								$this->lang->line('label_website'),  
								'valid_url');

		$this->form_validation->set_rules(
								'email', 
								$this->lang->line('label_email'),  
								'valid_email');

		if($this->form_validation->run() == FALSE) {

			$data['edit'] = true;
			$data['contact'] = $this->contact_model->get_by_id($id);

			if(!isset($data['contact']['active'])) {

				$this->lang->load('flash');
				$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_contact'));
				redirect('annuaire');
			}
			else {

				$functions = $this->contact_model->get_functions_of($id);
				$data['contact']['functions'] = array();

				foreach($functions as $f) {
					$data['contact']['functions'][] = $f['id'];
				}

				$data['functions'] = $this->function_model->get_all();

				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu');
				$this->load->view('admin/contact', $data);
				$this->load->view('templates/footer');
			}
		}
		else {

			$this->load->model('contact_model');
			$updatedContact = array(
				'active' => $this->input->post('active'),
				'title' => $this->input->post('title'),
				'lastname' => $this->input->post('lastname'),
				'firstname' => $this->input->post('firstname'),
				'telephone' => $this->input->post('telephone'),
				'mobile' => $this->input->post('mobile'),
				'fax' => $this->input->post('fax'),
				'decisionmaker' => $this->input->post('decisionmaker'),
				'company' => $this->input->post('company'),
				'address' => $this->input->post('address'),
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'country' => $this->input->post('country'),
				'website' => $this->input->post('website'),
				'email' => $this->input->post('email'),
				'photo' => $this->input->post('photo'),
				'comment' => $this->input->post('comment'),
				'lastmodified' => date('Y-m-d'),
				'modifiedby' => $this->session->id
			);

			if($this->input->post('postcode') == '')
				$updatedContact['postcode'] = null;
			else
				$updatedContact['postcode'] = $this->input->post('postcode');

			$this->contact_model->edit($id, $updatedContact, $this->input->post('functions'));
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_contact_edited'));
			redirect('annuaire');
		}
	}

	public function setContactActivity($id, $bool) {

		$this->load->model('contact_model');
		if($this->contact_model->set_active($id, $bool) == 0) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_contact'));
		}
		redirect('annuaire');
	}

	public function deleteContact($id) {

		$this->load->model('contact_model');
		if($this->contact_model->delete($id) == 0) {
			$this->lang->load('flash');
			$this->session->set_flashdata('error', $this->lang->line('flash_inexisting_contact'));
		}
		else {
			$this->lang->load('flash');
			$this->session->set_flashdata('success', $this->lang->line('flash_contact_deleted'));
		}
		redirect('annuaire');
	}

	public function checkExistingFunctions() {

		if(empty($this->input->post('functions'))) {
			$this->lang->load('error');
			$this->form_validation->set_message(
				'checkExistingFunctions', 
				$this->lang->line('error_required_functions'));
			return false;
		}
		$this->load->model('function_model');
		$ids = $this->function_model->get_existing_ids();
		foreach($this->input->post('functions') as $fonction) {
			if(!in_array($fonction, $ids)) {
				$this->lang->load('error');
				$this->form_validation->set_message(
					'checkExistingFunctions', 
					$this->lang->line('error_inexisting_functions'));
				return false;
			}
		}
		return true;
	}
}