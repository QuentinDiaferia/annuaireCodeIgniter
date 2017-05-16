<?php
require_once(APPPATH.'controllers/MainController.php');

class Connection extends MainController
{
    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->lang->load(array('error', 'forms', 'title'));

        $this->form_validation->set_rules('email', lang('label_email'), 'required|valid_email');
        $this->form_validation->set_rules('pwd', lang('label_password'), 'required');

        if (isset($this->session->admin)) {
            redirect('annuaire');
        } elseif ($this->form_validation->run()) {
            $this->load->model('user_model');
            $user = $this->user_model->login($this->input->post('email'), $this->input->post('pwd'));

            if (!$user) {
                $this->session->set_flashdata('error', lang('error_login'));
                redirect('');
            } elseif (!$user['active']) {
                $this->session->set_flashdata('error', lang('error_user_inactive'));
                redirect('');
            } else {
                $options = array(
                    'f_lastname' => null,
                    'f_firstname' => null,
                    'f_initial' => null,
                    'orderBy' => 'lastmodified',
                    'direction' => 'DESC');
                $this->session->set_userdata($user);
                $this->session->set_userdata($options);
                redirect('annuaire');
            }
        } else {
            $data['title'] = lang('title_login');
            $this->loadView('connexion', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
