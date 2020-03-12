<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Secure_Controller {
//class Admin extends CI_Controller {

	public function login() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$resources['page'] = 'login';
		$resources['page_title'] = 'Inicio de sesión';
		$resources['page_id'] = 'login';
		$this->load->view('admin/pages/login', $resources);
	}

	public function generator() {
		$resourses['scripts'] = ['assets/js/pages/generator.js'];
		admin_page('generator', 'Generador de links', 'generator', $resourses);
	}

	public function partners() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		$resourses['scripts'] = ['assets/js/pages/partners.js'];
		admin_page('partners', 'Asociados', 'partners', $resourses);
	}
	
	public function categories() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		$resourses['scripts'] = ['assets/js/pages/categories.js'];
		admin_page('categories', 'Categorias', 'categories', $resourses);
	}

	
	public function amounts() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		$resourses['scripts'] = ['assets/js/pages/amounts.js'];
		admin_page('amounts', 'Montos', 'amounts', $resourses);
	}
	
	public function credits() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		$resourses['scripts'] = ['assets/js/pages/credits.js'];
		admin_page('credits', 'Tipos de creditos', 'credits', $resourses);
	}


	
	public function params() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		admin_page('params', 'Parametros', 'params');
	}
	
	public function states() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}
		
		$resourses['scripts'] = ['assets/js/pages/states.js'];
		admin_page('states', 'Estados', 'states', $resourses);
	}
	
	public function records() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}
		
		$resourses['scripts'] = ['assets/js/pages/records.js'];
		admin_page('records', 'Records crediticios', 'records', $resourses);
	}
	
	public function codes() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}
		
		$resourses['scripts'] = ['assets/js/pages/codes.js'];
		admin_page('codes', 'Codigos', 'codes', $resourses);
	}
	
	public function documents() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}
		
		$resourses['scripts'] = ['assets/js/pages/documents.js'];
		admin_page('documents', 'Documentos', 'documents', $resourses);
	}

	public function users() {
		if (!checkAdmin($this->session->userdata('id'))) {header('location:'.site_url('/').'sin_acceso');}

		$resourses['scripts'] = ['assets/js/pages/users.js'];
		admin_page('users', 'Usuarios', 'users', $resourses);
	}

	public function uploadImage()
	{
		$input = $this->input->post();
		$upload_success=false;
		$config['upload_path']          = './assets/images/'.$input['type'];
		$config['overwrite']          = true;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']        = md5(date('dmYhisu'));
		
		$info=array();

		if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('image'))
		{
		  //NO SE SUBIO
			$this->response(['Sin permisos de escritura'], REST_Controller::HTTP_BAD_REQUEST);
		}else{
		  //SI SE SUBIO
		  $info = $this->upload->data();//la informacion del archivo subido
		  $upload_success=true;

		  $data = array(
		  	'image'=> $info['full_path']
		  );
		  $this->db->update( $input['type'], $data, array( 'id'=>$input['id'] ) );
		  
		  $response = new stdClass();
		  $response->$input['type'] = $this->db->get($input['type'])->result();
		  $response->msj = $input['type'].' image upload successfully.';
		  $this->response($response, REST_Controller::HTTP_OK);

		}



	}




}