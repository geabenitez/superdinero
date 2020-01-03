<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login() {
		$resources['styles'] = basic_styles();
		$resources['scripts'] = basic_scripts();
		$resources['page'] = 'login';
		$resources['page_title'] = 'Inicio de sesión';
		$resources['page_id'] = 'login';
		$this->load->view('admin/layout/index', $resources);
	}

	public function partners() {
		$resourses['scripts'] = ['assets/js/pages/partners.js'];
		admin_page('partners', 'Asociados', 'partners', $resourses);
	}
	public function categories() {
		admin_page('categories', 'Categorias', 'categories');
	}
	public function questions() {
		admin_page('questions', 'Preguntas calificatorias', 'questions');
	}
	public function amounts() {
		admin_page('amounts', 'Montos', 'amounts');
	}
	public function credits() {
		admin_page('credits', 'Tipos de creditos', 'credits');
	}
	public function params() {
		admin_page('params', 'Parametros', 'params');
	}

}