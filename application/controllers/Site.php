<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function index() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$resources['page'] = 'login';
		$resources['page_title'] = 'Inicio de sesión';
		$resources['page_id'] = 'login';
		$this->load->view('admin/pages/login', $resources);
	}

	public function login_process() {
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		echo $this->Users_model->login($email, $password);
	}
}
