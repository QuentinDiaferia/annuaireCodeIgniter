<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class FunctionManager extends Administration {

    public function __construct() {

        parent::__construct();
    }

    public function listFunctions($direction = 'ASC') {

        $this->lang->load('title');
        $data['title'] = $this->lang->line('title_admin_function');

        $this->load->model('function_model');

        $data['listFunctions'] = $this->function_model->get_all($direction);
        $data['direction'] = $direction;

        $this->genCSRFToken();

        $this->loadView('admin/functions', $data);
    }

    public function addFunction() {

        $this->lang->load(array('title', 'form'));
        $data['title'] = $this->lang->line('title_admin_function');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required');
        $this->form_validation->set_rules('active', $this->lang->line('label_active'), 'required|in_list[0,1]');
        
        if($this->form_validation->run() == FALSE) {

            $this->loadView('admin/function', $data);
        }
        else {

            $this->load->model('function_model');
            $newFunction = array(
                'name' => $this->input->post('name'),
                'active' => $this->input->post('active')
            );
            $this->function_model->add($newFunction);
            $this->lang->load('flash');
            $this->session->set_flashdata('success', $this->lang->line('flash_function_added'));
            redirect('admin/functions');
        }
    }

    public function editFunction($id) {

        $this->lang->load('title');
        $data['title'] = $this->lang->line('title_admin_function');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('function_model');

        $this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required');
        $this->form_validation->set_rules('active', $this->lang->line('label_active'), 'required|in_list[0,1]');
        
        if($this->form_validation->run() == FALSE) {

            $data['edit'] = true;
            $data['function'] = $this->function_model->get_by_id($id);

            if(!isset($data['function']['active'])) {

                $this->lang->load('flash');
                $this->session->set_flashdata('error', $this->lang->line('flash_inexisting_function'));
                redirect('admin/functions');
            }
            else {
            
                $this->loadView('admin/function', $data);
            }
        }
        else {

            $this->load->model('function_model');
            $updatedFunction = array(
                'name' => $this->input->post('name'),
                'active' => $this->input->post('active')
            );
            $this->function_model->edit($id, $updatedFunction);
            $this->lang->load('flash');
            $this->session->set_flashdata('success', $this->lang->line('flash_function_edited'));
            redirect('admin/functions');
        }
    }

    public function setFunctionActivity($id, $bool) {

        if($this->input->get('t') != $this->session->token) {
            $this->lang->load('flash');
            $this->session->set_flashdata('error', $this->lang->line('flash_access_forbidden'));
        }
        else {
            $this->load->model('function_model');
            if($this->function_model->set_active($id, $bool) == 0) {
                $this->lang->load('flash');
                $this->session->set_flashdata('error', $this->lang->line('flash_inexisting_function'));
            }
        }
        redirect('admin/functions');
    }
}