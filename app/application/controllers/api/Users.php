<?php
require APPPATH . 'libraries/REST_Controller.php';

class Users extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$enc = getallheaders();

    //validación por token
		if (!isset($enc['token-crf'])) {
			$this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
			echo json_encode( array('mensaje'=>'Sin acceso' ) );
			die();
		}else if($enc['token-crf']!='$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K') {
			$this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
			echo json_encode( array('mensaje'=>'Token no valido' ) );
			die();
		}
    //fin validación por token


	}


	public function index_get($id = 0){
		if (!empty($id)) {
			$data = $this->db->get_where("users", ['id' => $id])->row_array();
		} else {
			$data = $this->db->get("users")->result();
		}
		if(!empty($data)){
			foreach ($data as $k => $v) {unset($v->password); }
		}
		$this->response($data, REST_Controller::HTTP_OK);
	}


	public function index_post(){
		$input = json_decode($this->input->raw_input_stream);
		$this->db->insert('users',$input);
		
		$response = new stdClass();
		$response->success = true;
		$response->users = $this->db->get("users")->result();
		$response->msj = 'User added';
		$this->response($response, REST_Controller::HTTP_OK);
	} 

	public function index_put($id) {
		$input = $this->put();
		$input['updated_at'] = date("Y-m-d h:i:s");
		$this->db->update('users', $input, array('id'=>$id));
		
		$response = new stdClass();
		$response->success = true;
		$response->users = $this->db->get("users")->result();
		$response->msj = 'User updated successfully.';
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function index_delete($id) {
		$response = new stdClass();
		
		$this->db->delete('users', array('id'=>$id));
		$response->success = true;
		$response->msj = 'User deleted successfully.';
		$response->users = $this->db->get("users")->result();
		$this->response($response, REST_Controller::HTTP_OK);
	}





}

