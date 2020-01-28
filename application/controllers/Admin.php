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

	public function partners() {
		$resourses['scripts'] = ['assets/js/pages/partners.js'];
		admin_page('partners', 'Asociados', 'partners', $resourses);
	}
	
	public function categories() {
		$resourses['scripts'] = ['assets/js/pages/categories.js'];
		admin_page('categories', 'Categorias', 'categories', $resourses);
	}
	
	public function questions() {
		admin_page('questions', 'Preguntas calificatorias', 'questions');
	}
	
	public function amounts() {
		$resourses['scripts'] = ['assets/js/pages/amounts.js'];
		admin_page('amounts', 'Montos', 'amounts', $resourses);
	}
	
	public function credits() {
		admin_page('credits', 'Tipos de creditos', 'credits');
	}
	
	public function params() {
		admin_page('params', 'Parametros', 'params');
	}
	
	public function states() {
		$resourses['scripts'] = ['assets/js/pages/states.js'];
		admin_page('states', 'Estados', 'states', $resourses);
	}

	public function get_categories() {
		var_dump($this->db->get('categories'));
	}

}