<?php
require APPPATH . 'libraries/REST_Controller.php';

class Document extends REST_Controller {

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
    $this->response(getDocuments($id), REST_Controller::HTTP_OK);
  }

  public function index_post(){
    $input = json_decode($this->input->raw_input_stream);
    $this->db->insert('documents',$input);
    $response = new stdClass();
    $response->documents = $this->db->get("documents")->result();
    $response->msj = 'Document created successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('documents', $input, array('id'=>$id));
  
    $response = new stdClass();
    $response->documents = $this->db->get("documents")->result();
    $response->msj = 'Document updated successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {
    $this->db->delete('documents', array('id'=>$id));
      
    $response = new stdClass();
    $response->documents = $this->db->get("documents")->result();
    $response->msj = 'Document deleted successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);
  }  	
}