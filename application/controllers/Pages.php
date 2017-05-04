<?php
class Pages extends CI_Controller {

	public function index() {

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Email manquant'));
		$this->form_validation->set_rules('pwd', 'Mot de passe', 'required', array('required' => 'Mot de passe manquant'));

		if(isset($this->session->admin)) {

			if($this->session->admin)
				redirect('admin');
			else
				redirect('index');
		}
		else {

			if ($this->form_validation->run()) {

				$this->load->model('user_model');

				if($this->user_model->login($this->input->post('email'), $this->input->post('pwd')) == NULL) {

					$this->session->set_flashdata('error', 'Email ou mot de passe incorrect.');
					redirect('');
				}
				else {

					redirect('annuaire');
				}
			}
			else {

				$data['title'] = 'Connexion';

				$this->load->view('templates/header', $data);
				$this->load->view('connexion');
				$this->load->view('templates/footer');
			}
		}
	}

	public function logout() {

		$this->session->sess_destroy();
		redirect('');
	}

	public function annuaire($filter = null, $initial = null) {

		$data['title'] = 'Annuaire';

		$this->load->model('contact_model');

		if($filter == null) {

			$data['listContacts'] = $this->contact_model->get_all();
		}
		elseif($filter == 'initial') {

			$data['listContacts'] = $this->contact_model->get_by_initial($initial);
		}

		$data['nbContacts'] = $this->contact_model->count();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('annuaire', $data);
		$this->load->view('templates/footer');
	}
}