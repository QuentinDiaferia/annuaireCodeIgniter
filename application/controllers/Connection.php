<?php
require_once(APPPATH.'controllers/MainController.php');

class Connection extends MainController {

    public function login() {

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->lang->load(array('error', 'forms', 'title'));

        $this->form_validation->set_rules('email', $this->lang->line('label_email'), 'required');
        $this->form_validation->set_rules('pwd', $this->lang->line('label_password'), 'required');

        if(isset($this->session->admin)) {

            if($this->session->admin)
                redirect('admin');
            else
                redirect('annuaire');
        }
        else {

            if ($this->form_validation->run()) {

                $this->load->model('user_model');

                if(!$this->user_model->login($this->input->post('email'), $this->input->post('pwd'))) {

                    $this->session->set_flashdata('error', $this->lang->line('error_login'));
                    redirect('');
                }
                else {

                    redirect('annuaire');
                }
            }
            else {

                $data['title'] = $this->lang->line('title_login');

                $this->loadView('connexion', $data);
            }
        }
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('');
    }
}