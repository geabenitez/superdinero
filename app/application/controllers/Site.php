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
			$result = $this->db->get_where("codes", ['codigo' => strtoupper($code)])->result();

			if (!$result) {
			var_dump($result);

			die();
				header('location:'.site_url('/').'404');
			}

			$users_data = $this->db->get_where("users", ['id' => $result[0]->agent])->result(); 

			$code_user = null;
			if (!empty($users_data)) {
				$code_user = strtoupper($users_data[0]->code);
			}
			
			//echo $result[0]->configuracion;
			
			$conf = json_decode($result[0]->configuracion);
			$to_send =  array(
				'agent' => $code_user,
				'data' => $result[0]->configuracion,
				 );
			

			$credits = getCredits($conf->credit);
			if (!isset($credits[0]['slug'])) {
				# code...
			}

			$string = base64_encode(json_encode($to_send));
			
			
			//$string = base64_encode($result[0]->configuracion);
			// site_url('/ofertas/'.$credits[0]['slug'].'?=d='.$string);
			header('location:'.site_url('/ofertas/'.$credits[0]['slug'].'?d='.$string));
	

		
		

		/*$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		array_push($resources['scripts'], 'assets/js/pages/offers.js');
		$this->load->view('site/offers', $resources);*/
	}







	public function redirect() {
		$resources['redirect'] = $_GET['redirect'];
		$resources['params'] = (isset($_GET['params']))?$_GET['params']:array();

		$partnerData = $this->db->get_where("partners", ['id' => $_GET['partner']])->row_array();

		
		if (empty($partnerData)) {
			header('location:'.site_url('/').'404');
		}
		$resources['partner'] = $partnerData['nameES'];
		$resources['image'] = $partnerData['image'];


		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$this->load->view('site/redirection', $resources);
	}

	public function get_credits($id="") {
		
		echo json_encode(getCredits($id));
	}


	public function get_categories($id="") {
		echo json_encode(getCategories($id));
	}

	public function get_amounts($id="") {
		echo json_encode(getAmounts($id));
	}

	public function get_documents($id="") {
		echo json_encode(getDocuments($id));
	}

	public function get_records($id="") {
		echo json_encode(getRecords($id));
	}

	public function get_states($id="") {
		echo json_encode(getStates($id));
	}

	public function get_partners($id="") {
		echo json_encode(getPartners($id));
	}

	public function get_codes($id="") {
		echo json_encode(getCodes($id));
	}

	public function uploadImage()
	{
		$input = $this->input->post();
		

		$upload_success=false;
		$config['upload_path']          = './assets/images/'.$input['type'];
		$config['overwrite']          = true;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']        = md5(date('dmYhisu'));
		$real_path =  str_replace('\\','/',realpath(''));
		

		$info=array();

		// die(var_dump($config['upload_path']));
		if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
		$this->load->library('upload', $config);

		$response = new stdClass();
		if ( ! $this->upload->do_upload('image'))
		{
		  //NO SE SUBIO
			//$this->response(['Sin permisos de escritura'], REST_Controller::HTTP_BAD_REQUEST);
			
			// echo 'No se logro subir la imagen'.($this->upload->display_errors());
			$response->msj = "Error al subir la imagen, contacta a tu administrador.";
		  $response->success = false;

		}else{
		  //SI SE SUBIO
			
			$old_data = $this->db->get_where($_REQUEST['type'], ['id' => $_REQUEST['id']])->row_array();
			if(!empty($old_data)){ if(!empty($old_data['image'])){@unlink($old_data['image']);}  }

		  $info = $this->upload->data();//la informacion del archivo subido
		  $upload_success=true;

		  $data = array(
		  	//'image'=> $info['file_name']
		  	'image'=> 'assets/images/'.$_REQUEST['type'].'/'.$info['file_name']
		  );
		 
		  $this->db->update( $_REQUEST['type'], $data, array( 'id'=>$_REQUEST['id'] ) );
		  
		  
			$d = $_REQUEST['type'];
		  $response->$d = $_REQUEST['type'] == 'partners' ? getPartners(null) : getCredits(null);
		  $response->msj = $_REQUEST['type'].' image upload successfully.';
		  $response->success = true;
		  echo json_encode($response);

		}



	}

}
