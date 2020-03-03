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

	public function questionnaire($slug) {
		$resources['slug'] = $this->db->get_where("credits", ['slug' => $slug])->result();			
		if(!$resources['slug']){
			header('location:'.site_url('/').'404');
		}

		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		array_push($resources['scripts'], 'assets/js/pages/questionnaire.js');
		$this->load->view('site/questionnaire', $resources);
	}

	public function offers($slug) {
		// $categories = $this->db->get("categories")->result();
		// $categories = array_map(function ($var) {
		// 	# code...
		// }, $categories)

		
		$this->db->where('nameES', $slug );
		$this->db->or_where('nameEN', $slug );
		$query = $this->db->get('credits')->result();
		if(empty($query)){header('location:'.site_url('/').'404');}


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

	public function get_credits() {
		echo json_encode(getCredits($this->input->get('id', 0)));
	}

}
