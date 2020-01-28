<?php
require APPPATH . 'libraries/REST_Controller.php';

class Category extends REST_Controller {
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
      $data = $this->db->get_where("categories", ['id' => $id])->row_array();
    } else {
      $data = $this->db->get("categories")->result();
    }
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function index_post(){
    $input = $this->input->post();
    $this->db->insert('categories',$input);
    $this->response(['Category created successfully.'], REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $this->db->update('categories', $input, array('id'=>$id));

    $this->response(['Category updated successfully.'], REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {
    $this->db->delete('categories', array('id'=>$id));
    
    $this->response(['Category deleted successfully.'], REST_Controller::HTTP_OK);
  }  	
}