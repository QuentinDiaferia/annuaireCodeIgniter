<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class FunctionManager extends Administration {

	public function __construct() {

		parent::__construct();
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
			$this->session->set_flashdata('success', 'Fonction ajoutée.');
			redirect('admin/functions');
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

			if(!isset($data['function']['active'])) {

				$this->session->set_flashdata('error', 'Fonction inexistante.');
				redirect('admin/functions');
			}
			else {
			
				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu');
				$this->load->view('admin/function', $data);
				$this->load->view('templates/footer');
			}
		}
		else {

			$this->load->model('function_model');
			$this->function_model->edit($id);
			$this->session->set_flashdata('success', 'Fonction modifiée.');
			redirect('admin/functions');
		}
	}

	public function setFunctionActivity($id, $bool) {

		$this->load->model('function_model');
		if($this->function_model->set_active($id, $bool) == 0)
			$this->session->set_flashdata('error', 'Function inexistante.');
		redirect('admin/functions');
	}
}