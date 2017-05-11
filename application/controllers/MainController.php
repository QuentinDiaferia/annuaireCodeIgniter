<?php
class MainController extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->output->enable_profiler(TRUE);
        $this->lang->load(array('templates', 'forms'));
    }

    public function loadView($view, $data) {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('templates/flashdata');
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    public function genCSRFToken() {
        $this->session->set_userdata(array(
            'token' => bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM))
        ));
    }
}