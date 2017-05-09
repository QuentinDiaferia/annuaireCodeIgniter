<?php
class MainController extends CI_Controller {

	public function __construct() {

		parent::__construct();
	}

	public function loadView($view, $data) {

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view($view, $data);
		$this->load->view('templates/footer');
	}
}