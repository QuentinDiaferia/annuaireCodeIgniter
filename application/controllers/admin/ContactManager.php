<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class ContactManager extends Administration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addContact()
    {
        $this->lang->load(array('title', 'forms'));
        $data['title'] = lang('title_admin_contact');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
                                'active',
                                lang('label_active'),
                                'required|in_list[0,1]|callback_checkExistingFunctions');

        $this->form_validation->set_rules(
                                'title',
                                lang('label_title'),
                                'required|in_list[mle,mad,mon]');

        $this->form_validation->set_rules(
                                'lastname',
                                lang('label_lastname'),
                                'trim|required|strtoupper');

        $this->form_validation->set_rules(
                                'firstname',
                                lang('label_firstname'),
                                'trim|required|ucfirst');

        $this->form_validation->set_rules(
                                'telephone',
                                lang('label_telephone'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'mobile',
                                lang('label_mobile'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'fax',
                                lang('label_fax'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'decisionmaker',
                                lang('label_decisionmaker'),
                                'in_list[0,1]');

        $this->form_validation->set_rules(
                                'company',
                                lang('label_company'),
                                'trim|required|ucfirst');

        $this->form_validation->set_rules(
                                'functions[]',
                                lang('label_functions'),
                                'required|integer');

        $this->form_validation->set_rules(
                                'postcode',
                                lang('label_postcode'),
                                'trim|integer|exact_length[5]');

        $this->form_validation->set_rules(
                                'website',
                                lang('label_website'),
                                'trim|regex_match[#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#]');

        $this->form_validation->set_rules(
                                'email',
                                lang('label_email'),
                                'trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->database();
            $this->load->model('function_model');

            $data['functions'] = $this->function_model->get_all();

            $this->loadView('admin/contact', $data);
        } else {
            $config['upload_path'] = 'upload';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 800;
            $config['file_ext_tolower'] = true;
            $this->load->library('upload', $config);

            if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0 && !$this->upload->do_upload('photo')) {
                $data['error'] = $this->upload->display_errors();
                $this->load->database();
                $this->load->model('function_model');
                $data['functions'] = $this->function_model->get_all();
                $this->loadView('admin/contact', $data);
            } else {
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
                    'photo' => $this->upload->data('file_name'),
                    'comment' => $this->input->post('comment'),
                    'lastmodified' => date('Y-m-d'),
                    'modifiedby' => $this->session->id
                );

                if ($this->input->post('postcode') == '') {
                    $newContact['postcode'] = null;
                } else {
                    $newContact['postcode'] = $this->input->post('postcode');
                }

                $this->contact_model->add($newContact, $this->input->post('functions'));
                $this->lang->load('flash');
                $this->session->set_flashdata('success', lang('flash_contact_added'));
                redirect('annuaire');
            }
        }
    }

    public function editContact($id)
    {
        $this->lang->load(array('title', 'forms'));
        $data['title'] = lang('title_admin_contact');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('contact_model');
        $this->load->model('function_model');

        $this->form_validation->set_rules(
                                'active',
                                lang('label_active'),
                                'required|in_list[0,1]|callback_checkExistingFunctions');

        $this->form_validation->set_rules(
                                'title',
                                lang('label_title'),
                                'required|in_list[mle,mad,mon]');

        $this->form_validation->set_rules(
                                'lastname',
                                lang('label_lastname'),
                                'trim|required|strtoupper');

        $this->form_validation->set_rules(
                                'firstname',
                                lang('label_firstname'),
                                'trim|required|ucfirst');

        $this->form_validation->set_rules(
                                'telephone',
                                lang('label_telephone'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'mobile',
                                lang('label_mobile'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'fax',
                                lang('label_fax'),
                                'trim|regex_match[#^0[1-68]([-. ]?[0-9]{2}){4}$#]');

        $this->form_validation->set_rules(
                                'decisionmaker',
                                lang('label_decisionmaker'),
                                'in_list[0,1]');

        $this->form_validation->set_rules(
                                'company',
                                lang('label_company'),
                                'trim|required|ucfirst');

        $this->form_validation->set_rules(
                                'functions[]',
                                lang('label_functions'),
                                'required|integer');

        $this->form_validation->set_rules(
                                'postcode',
                                lang('label_postcode'),
                                'trim|integer|exact_length[5]');

        $this->form_validation->set_rules(
                                'website',
                                lang('label_website'),
                                'trim|regex_match[#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#]');

        $this->form_validation->set_rules(
                                'email',
                                lang('label_email'),
                                'trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['edit'] = true;
            $data['contact'] = $this->contact_model->get_by_id($id)[0];

            if (!isset($data['contact']['active'])) {
                $this->lang->load('flash');
                $this->session->set_flashdata('error', lang('flash_inexisting_contact'));
                redirect('annuaire');
            } else {
                $data['contact']['function_ids'] = explode(',', $data['contact']['function_ids']);
                $data['contact']['function_names'] = explode(',', $data['contact']['function_names']);

                $data['functions'] = $this->function_model->get_all();

                $this->loadView('admin/contact', $data);
            }
        } else {
            $config['upload_path'] = 'upload';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 800;
            $config['file_ext_tolower'] = true;
            $this->load->library('upload', $config);

            if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0 && !$this->upload->do_upload('photo')) {
                $data['error'] = $this->upload->display_errors();
                $this->load->database();
                $this->load->model('function_model');
                $data['functions'] = $this->function_model->get_all();
                $this->loadView('admin/contact', $data);
            } else {
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
                    'comment' => $this->input->post('comment'),
                    'lastmodified' => date('Y-m-d'),
                    'modifiedby' => $this->session->id
                );

                if ($this->upload->data('file_name') != null) {
                    $updatedContact['photo'] = $this->upload->data('file_name');
                    unlink('upload/'.$this->input->post('oldPhoto'));
                } else {
                    $updatedContact['photo'] = $this->input->post('oldPhoto');
                }

                if ($this->input->post('postcode') == '') {
                    $updatedContact['postcode'] = null;
                } else {
                    $updatedContact['postcode'] = $this->input->post('postcode');
                }

                $this->contact_model->edit($id, $updatedContact, $this->input->post('functions'));
                $this->lang->load('flash');
                $this->session->set_flashdata('success', lang('flash_contact_edited'));
                redirect('annuaire');
            }
        }
    }

    public function setContactActivity($id, $bool)
    {
        $this->load->model('contact_model');
        $this->lang->load('flash');
        if ($this->contact_model->set_active($id, $bool) == 0) {
            $this->session->set_flashdata('error', lang('flash_inexisting_contact'));
        } else {
            $this->session->set_flashdata('success', lang('flash_contact_edited'));
        }
        redirect('annuaire');
    }

    public function deleteContact($id)
    {
        $this->load->model('contact_model');
        if ($this->contact_model->delete($id) == 0) {
            $this->lang->load('flash');
            $this->session->set_flashdata('error', lang('flash_inexisting_contact'));
        } else {
            $this->lang->load('flash');
            $this->session->set_flashdata('success', lang('flash_contact_deleted'));
        }
        redirect('annuaire');
    }

    public function checkExistingFunctions()
    {
        if (empty($this->input->post('functions'))) {
            $this->lang->load('error');
            $this->form_validation->set_message(
                'checkExistingFunctions',
                lang('error_required_functions'));
            return false;
        }
        $this->load->model('function_model');
        if (!$this->function_model->check_existing_ids($this->input->post('functions'))) {
            $this->lang->load('error');
            $this->form_validation->set_message(
                'checkExistingFunctions',
                lang('error_inexisting_functions'));
            return false;
        }
        return true;
    }
}
