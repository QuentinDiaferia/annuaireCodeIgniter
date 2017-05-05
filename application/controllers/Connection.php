<?php
class Connection extends CI_Controller {

	public function login() {

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Email manquant'));
		$this->form_validation->set_rules('pwd', 'Mot de passe', 'required', array('required' => 'Mot de passe manquant'));

		if(isset($this->session->admin)) {

			if($this->session->admin)
				redirect('admin');
			else
				redirect('annuaire');
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
}