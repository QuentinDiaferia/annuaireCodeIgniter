<?php
require_once(APPPATH.'controllers/MainController.php');

class Client extends MainController {

    public function __construct() {

        parent::__construct();
        if(!isset($this->session->admin)) {
            $this->lang->load('flash_lang');
            $this->session->set_flashdata('error', $this->lang->line('flash_access_forbidden'));
            redirect('connexion');
        }
    }

    public function index() {

        $this->lang->load('title_lang');

        $data['title'] = $this->lang->line('title_client_index');

        $this->loadView('client/annuaire', $data);
    }

    public function reset() {

        $this->session->set_userdata('filter', null);
        $this->session->set_userdata('value', null);
        $this->session->set_userdata('orderBy', 'lastmodified');
        $this->session->set_userdata('direction', 'DESC');
        redirect('annuaire');
    }

    public function orderBy($orderBy, $direction) {

        $this->session->set_userdata('orderBy', $orderBy);
        $this->session->set_userdata('direction', $direction);
        redirect('annuaire');
    }

    public function filterBy($filter, $value = null) {
        if($filter != 'initial' && $this->input->post($filter) == null) {
            $this->session->set_userdata('filter', null);
            $this->session->set_userdata('value', null);
        }
        else {
            $this->session->set_userdata('filter', $filter);
            if($value == null)
                $this->session->set_userdata('value', $this->input->post($filter));
            else
                $this->session->set_userdata('value', $value);
        }
        redirect('annuaire');
    }

    public function annuaire($page = 0) {

        $this->lang->load('title_lang');
        $data['title'] = $this->lang->line('title_main_page');

        $this->load->helper('form');
        $this->load->model('contact_model');

        $data['nbContacts'] = $this->contact_model->countWithFilter();

        $this->load->library('pagination');
        $config['total_rows'] = $data['nbContacts'];
        $config['base_url'] = site_url('annuaire');
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['next_link'] = '&gt;&gt;';
        $config['prev_link'] = '&lt;&lt;';
        $config['num_tag_open'] = ' - ';
        $config['num_tag_close'] = ' - ';
        $config['full_tag_open'] = '<p class="text-center">';
        $config['full_tag_close'] = '</p>';

        $data['listContacts'] = $this->contact_model->get_all($page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->loadView('annuaire', $data);
    }

    public function contact($id) {

        $this->lang->load('title_lang');
        $data['title'] = $this->lang->line('title_client_contact');

        $this->load->model('contact_model');

        $data['contact'] = $this->contact_model->get_by_id($id)[0];

        if(!isset($data['contact']['active']) || !$data['contact']['active']) {

            $this->lang->load('flash_lang');
            $this->session->set_flashdata('error', $this->lang->line('flash_inexisting_contact'));
            redirect('annuaire');
        }
        else {

            $data['contact']['function_ids'] = explode(',', $data['contact']['function_ids']);
            $data['contact']['function_names'] = explode(',', $data['contact']['function_names']);
            $this->loadView('client/contact', $data);
        }
    }
}