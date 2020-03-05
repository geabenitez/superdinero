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

}