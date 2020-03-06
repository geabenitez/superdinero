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


		public function check() {
			$code = $this->input->get("code");
			$result = $this->db->get_where("codes", ['codigo' => $code])->result();

			if (!$result) {
				header('location:'.site_url('/').'404');
			}


			//echo $result[0]->configuracion;
			
			$conf = json_decode($result[0]->configuracion);
			
			$credits = getCredits($conf->credit);
			if (!isset($credits[0]['slug'])) {
				# code...
			}
			
			$string = base64_encode($result[0]->configuracion);
			// site_url('/ofertas/'.$credits[0]['slug'].'?=d='.$string);
			header('location:'.site_url('/ofertas/'.$credits[0]['slug'].'?d='.$string));
	

		
		

		/*$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		array_push($resources['scripts'], 'assets/js/pages/offers.js');
		$this->load->view('site/offers', $resources);*/
	}







	public function redirect() {
		$resources['redirect'] = $_GET['redirect'];

		$partnerData = $this->db->get_where("partners", ['id' => $_GET['partner']])->row_array();

		
		if (empty($partnerData)) {
			header('location:'.site_url('/').'404');
		}
		$resources['partner'] = $partnerData['nameES'];


		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$this->load->view('site/redirection', $resources);
	}

	public function get_credits($id) {
		return json_encode(getCredits($id));
	}


	public function get_categories($id) {
		return json_encode(getCategories($id));
	}

	public function get_amounts($id) {
		return json_encode(getAmounts($id));
	}

	public function get_documents($id) {
		return json_encode(getDocuments($id));
	}

	public function get_records($id) {
		return json_encode(getRecords($id));
	}

	public function get_states($id) {
		return json_encode(getStates($id));
	}

	public function get_partners($id) {
		return json_encode(getPartners($id));
	}

	public function get_codes($id) {
		return json_encode(getCodes($id));
	}

}
