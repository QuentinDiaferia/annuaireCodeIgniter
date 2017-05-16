<?php
require_once(APPPATH.'controllers/MainController.php');

class Client extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->admin)) {
            $this->lang->load('flash_lang');
            $this->session->set_flashdata('error', lang('flash_access_forbidden'));
            redirect('connexion');
        }
    }

    public function index()
    {
        $this->lang->load('title_lang');

        $data['title'] = lang('title_client_index');

        $this->loadView('client/annuaire', $data);
    }

    public function reset($filter = null)
    {
        if ($filter == null) {
            $options = array(
                'f_lastname' => null,
                'f_firstname' => null,
                'f_initial' => null,
                'orderBy' => 'lastmodified',
                'direction' => 'DESC');
            $this->session->set_userdata($options);
        } elseif ($filter == 'lastname' || $filter == 'firstname' || $filter == 'initial') {
            $this->session->set_userdata('f_'.$filter, null);
        }
        redirect('annuaire');
    }

    public function orderBy($orderBy, $direction)
    {
        $this->session->set_userdata('orderBy', $orderBy);
        $this->session->set_userdata('direction', $direction);
        redirect('annuaire');
    }

    public function filterBy($filter, $value = null)
    {
        if ($filter != 'initial' && $this->input->post($filter) == null) {
            $this->session->set_userdata('f_'.$filter, null);
        } elseif ($value == null) {
            $this->session->set_userdata('f_'.$filter, $this->input->post($filter));
        } else {
            $this->session->set_userdata('f_'.$filter, $value);
        }
        redirect('annuaire');
    }

    public function annuaire($page = 0)
    {
        $this->lang->load('title_lang');
        $data['title'] = lang('title_main_page');

        $this->load->helper('form');
        $this->load->model('contact_model');

        $data['nbContacts'] = $this->contact_model->countWithFilter();

        $this->load->library('pagination');
        $config['total_rows'] = $data['nbContacts'];
        $config['base_url'] = site_url('annuaire');
        $config['per_page'] = 10;
        $config['use_page_numbers'] = true;
        $config['full_tag_open'] = '<div id="pagination"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tagl_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tagl_close'] = '</li>';

        $data['listContacts'] = $this->contact_model->get_all($page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->loadView('annuaire', $data);
    }

    public function contact($id)
    {
        $this->lang->load('title_lang');
        $data['title'] = lang('title_client_contact');

        $this->load->model('contact_model');

        $data['contact'] = $this->contact_model->get_by_id($id)[0];

        if (!isset($data['contact']['active']) || !$data['contact']['active']) {
            $this->lang->load('flash_lang');
            $this->session->set_flashdata('error', lang('flash_inexisting_contact'));
            redirect('annuaire');
        } else {
            $data['contact']['function_ids'] = explode(',', $data['contact']['function_ids']);
            $data['contact']['function_names'] = explode(',', $data['contact']['function_names']);
            $this->loadView('client/contact', $data);
        }
    }
}
