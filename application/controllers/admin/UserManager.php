<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class UserManager extends Administration {

    public function __construct() {

        parent::__construct();
        if(!isset($this->session->admin) || !$this->session->admin) {
            $this->lang->load('flash');
            $this->session->set_flashdata('error', lang('flash_access_forbidden'));
            redirect('annuaire');
        }
    }

    public function listUsers($direction = 'ASC') {

        $this->lang->load('title');
        $this->load->helper('form');

        $data['title'] = lang('title_admin_user');

        $this->load->model('user_model');

        $data['listUsers'] = $this->user_model->get_all($direction);
        $data['direction'] = $direction;

        $this->loadView('admin/users', $data);
    }

    public function addUser() {

        $this->lang->load(array('title', 'forms'));
        $data['title'] = lang('title_admin_user');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();

        $this->form_validation->set_rules(
                                'active', 
                                lang('label_active'), 
                                'required|in_list[0,1]');

        $this->form_validation->set_rules(
                                'title', 
                                'Civilité', 
                                'required|in_list[mle,mad,mon]');

        $this->form_validation->set_rules(
                                'password', 
                                lang('label_password'), 
                                'required');

        $this->form_validation->set_rules(
                                'admin', 
                                lang('label_statut'),
                                'required|in_list[0,1]');

        $this->form_validation->set_rules(
                                'lastname', 
                                lang('label_lastname'),
                                'trim|required|strtoupper');

        $this->form_validation->set_rules(
                                'firstname', 
                                lang('label_firstname'),
                                'trim|ucfirst');

        $this->form_validation->set_rules(
                                'birthday', 
                                lang('label_birthday'),
                                'trim|callback_checkBirthDate');

        $this->form_validation->set_rules(
                                'address', 
                                lang('label_address'),
                                'trim|required');

        $this->form_validation->set_rules(
                                'postcode', 
                                lang('label_postcode'), 
                                'trim|required|integer|exact_length[5]');

        $this->form_validation->set_rules(
                                'city', 
                                lang('label_city'), 
                                'trim|required');

        $this->form_validation->set_rules(
                                'country', 
                                lang('label_country'),
                                'trim|required');

        $this->form_validation->set_rules(
                                'telephone', 
                                lang('label_telephone'),
                                'trim|required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'email', 
                                lang('label_email'), 
                                'trim|required|valid_email|is_unique[users.email]');

        if($this->form_validation->run() == FALSE) {

            $this->loadView('admin/user', $data);
        }
        else {

            $this->load->model('user_model');
            $newUser = array(
                'active' => $this->input->post('active'),
                'title' => $this->input->post('title'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
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
                $updatedUser['birthday'] = DateTime::createFromFormat(lang('date_format'), $this->input->post('birthday'))->format('Y-m-d');
            else
                $updatedUser['birthday'] = null;
            
            $this->user_model->add($newUser);
            $this->lang->load('flash');
            $this->session->set_flashdata('success', lang('flash_user_added'));
            redirect('admin/users');
        }
    }

    public function editUser($id) {

        $this->lang->load('title');
        $data['title'] = lang('title_admin_user');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');

        if($id != $this->session->id) {
            $this->form_validation->set_rules(
                                'active', 
                                lang('label_active'), 
                                'required|in_list[0,1]');
        }

        $this->form_validation->set_rules(
                                'title', 
                                'Civilité', 
                                'required|in_list[mle,mad,mon]');

        $this->form_validation->set_rules(
                                'admin', 
                                lang('label_statut'),
                                'required|in_list[0,1]');

        $this->form_validation->set_rules(
                                'lastname', 
                                lang('label_lastname'),
                                'trim|required|strtoupper');

        $this->form_validation->set_rules(
                                'firstname', 
                                lang('label_firstname'),
                                'trim|ucfirst');

        $this->form_validation->set_rules(
                                'birthday', 
                                lang('label_birthday'),
                                'trim|callback_checkBirthDate');

        $this->form_validation->set_rules(
                                'address', 
                                lang('label_address'),
                                'trim|required');

        $this->form_validation->set_rules(
                                'postcode', 
                                lang('label_postcode'), 
                                'trim|required|integer|exact_length[5]');

        $this->form_validation->set_rules(
                                'city', 
                                lang('label_city'), 
                                'trim|required');

        $this->form_validation->set_rules(
                                'country', 
                                lang('label_country'),
                                'trim|required');

        $this->form_validation->set_rules(
                                'telephone', 
                                lang('label_telephone'),
                                'trim|required|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'email', 
                                lang('label_email'),
                                'trim|required|valid_email|callback_checkEmail['.$id.']');

        if($this->form_validation->run() == FALSE) {

            $data['edit'] = true;
            $data['user'] = $this->user_model->get_by_id($id);

            if(!isset($data['user']['active'])) {

                $this->lang->load('flash');
                $this->session->set_flashdata('error', lang('flash_inexisting_contact'));
                redirect('admin/users');
            }
            else {
            
                $this->loadView('admin/user', $data);
            }
        }
        else {

            $this->load->model('user_model');
            $updatedUser = array(
                'title' => $this->input->post('title'),
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

            if($this->input->post('password') != null)
                $updatedUser['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            if($id != $this->session->id)
                $updatedUser['active'] = $this->input->post('active');
            else
                $updatedUser['active'] = 1;

            if($this->input->post('birthday') != null)
                $updatedUser['birthday'] = DateTime::createFromFormat(lang('date_format'), $this->input->post('birthday'))->format('Y-m-d');
            else
                $updatedUser['birthday'] = null;

            $this->user_model->edit($id, $updatedUser);
            $this->lang->load('flash');
            $this->session->set_flashdata('success', lang('flash_user_edited'));
            redirect('admin/users');
        }
    }

    public function setUserActivity($id, $bool) {

        if($id == $this->session->id) {
            $this->lang->load('flash');
            $this->session->set_flashdata('error', lang('flash_access_forbidden'));
        }
        else {
            $this->load->model('user_model');
            $this->lang->load('flash');
            if($this->user_model->set_active($id, $bool) == 0) {
                $this->session->set_flashdata('error', lang('flash_inexisting_user'));
            }
            else {
                $this->session->set_flashdata('success', lang('flash_user_edited'));
            }
        }
        redirect('admin/users');
    }

    public function deleteUser($id) {

        if($id == $this->session->id) {
            $this->lang->load('flash');
            $this->session->set_flashdata('error', lang('flash_access_forbidden'));
        }
        else {
                $this->load->model('user_model');
            if($this->user_model->delete($id) == 0) {
                $this->lang->load('flash');
                $this->session->set_flashdata('error', lang('flash_inexisting_user'));
            }
            else {
                $this->lang->load('flash');
                $this->session->set_flashdata('success', lang('flash_user_deleted'));
            }
        }
        redirect('admin/users');
    }

    public function checkEmail($email, $id) {

        if(!$this->user_model->email_unique($id, $this->input->post('email'))) {

            $this->lang->load('error');
            $this->form_validation->set_message(
                                    'checkEmail', 
                                    lang('error_email'));
            return false;
        }
        return true;
    }

    public function checkBirthDate($date) {

        if($date != null) {

            $date = DateTime::createFromFormat(lang('date_format'), $date);
            if(!$date || $date > new DateTime('now') || $date < new DateTime('1900-01-01')) {
                
                $this->lang->load('error');
                $this->form_validation->set_message(
                                        'checkBirthDate', 
                                        lang('error_birthday'));
                return false;
            }
        }
        return true;
    }
}