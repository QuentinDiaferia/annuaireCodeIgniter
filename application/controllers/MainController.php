<?php
class MainController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->lang->load(array('templates', 'forms'));
        $this->load->helper('language');
    }

    public function loadView($view, $data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('templates/flashdata');
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    public function error404()
    {
        $this->lang->load('title');
        $data['title'] = lang('title_404');
        $this->loadView('error404', $data);
    }
}
