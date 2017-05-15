<?php
require_once(APPPATH.'controllers/admin/Administration.php');

class FunctionManager extends Administration {

    public function __construct() {

        parent::__construct();
    }

    public function listFunctions($direction = 'ASC') {

        $this->lang->load('title');
        $this->load->helper('form');
        $data['title'] = lang('title_admin_function');

        $this->load->model('function_model');

        $data['listFunctions'] = $this->function_model->get_all($direction);
        $data['direction'] = $direction;

        $this->loadView('admin/functions', $data);
    }

    public function addFunction() {

        $this->lang->load(array('title', 'forms'));
        $data['title'] = lang('title_admin_function');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('label_name'), 'trim|required');
        $this->form_validation->set_rules('active', lang('label_active'), 'required|in_list[0,1]');
        
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
            $this->session->set_flashdata('success', lang('flash_function_added'));
            redirect('admin/functions');
        }
    }

    public function editFunction($id) {

        $this->lang->load('title');
        $data['title'] = lang('title_admin_function');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('function_model');

        $this->form_validation->set_rules('name', lang('label_name'), 'trim|required');
        $this->form_validation->set_rules('active', lang('label_active'), 'required|in_list[0,1]');
        
        if($this->form_validation->run() == FALSE) {

            $data['edit'] = true;
            $data['function'] = $this->function_model->get_by_id($id);

            if(!isset($data['function']['active'])) {

                $this->lang->load('flash');
                $this->session->set_flashdata('error', lang('flash_inexisting_function'));
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
            $this->session->set_flashdata('success', lang('flash_function_edited'));
            redirect('admin/functions');
        }
    }

    public function setFunctionActivity($id, $bool) {
 
        $this->load->model('function_model');
        $this->lang->load('flash');
        if($this->function_model->set_active($id, $bool) == 0) {
            $this->session->set_flashdata('error', lang('flash_inexisting_function'));
        }
        else {
            $this->session->set_flashdata('success', lang('flash_function_edited'));
        }
        redirect('admin/functions');
    }
}