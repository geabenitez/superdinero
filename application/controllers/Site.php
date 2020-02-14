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
		array_push($resources['scripts'], 'assets/js/pages/login.js');
		$resources['page'] = 'login';
		$resources['page_title'] = 'Inicio de sesión';
		$resources['page_id'] = 'login';
		$this->load->view('admin/pages/login', $resources);
	}

	public function login_process() {
		$data = json_decode($this->input->raw_input_stream);
		echo $this->Users_model->login($data->email, $data->password);
	}

	public function process_logout() {
		$this->session->sess_destroy();
		redirect(site_url('/'));
	}

	public function questionnaire() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		array_push($resources['scripts'], 'assets/js/pages/questionnaire.js');
		$this->load->view('site/questionnaire', $resources);
	}

	public function offers() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		array_push($resources['scripts'], 'assets/js/pages/offers.js');
		$this->load->view('site/offers', $resources);
	}

	public function redirect() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$this->load->view('site/redirection', $resources);
	}
}
