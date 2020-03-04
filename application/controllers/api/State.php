<?php
require APPPATH . 'libraries/REST_Controller.php';

class State extends REST_Controller {

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
    $this->response(getStates($id), REST_Controller::HTTP_OK);
  }

  public function index_post(){
    $input = json_decode($this->input->raw_input_stream);
    $this->db->insert('states',$input);
    $response = new stdClass();
    $response->states = $this->db->get("states")->result();
    $response->msj = 'State created successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('states', $input, array('id'=>$id));
  
    $response = new stdClass();
    $response->states = $this->db->get("states")->result();
    $response->msj = 'State updated successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {
    $this->db->delete('states', array('id'=>$id));
      
    $response = new stdClass();
    $response->states = $this->db->get("states")->result();
    $response->msj = 'State deleted successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  }  	
}