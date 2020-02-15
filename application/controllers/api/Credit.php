<?php
require APPPATH . 'libraries/REST_Controller.php';

class Credit extends REST_Controller {

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
      $data = $this->db->get_where("credits", ['id' => $id])->row_array();
    } else {
      $data = $this->db->get("credits")->result();
    }
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function index_post(){
    $input = json_decode($this->input->raw_input_stream);
    
    //prepare array for credits
    $credit = array('nameES'=>$input->nameES, 'nameEN'=>$input->nameEN, 'maxAmount'=>$input->maxAmount, 'active'=>1 );
    
    $this->db->insert('credits',$credit);

    //get the last id inserted
    $insert_id = $this->db->insert_id();

    //prepared the insert for credits_categories
    $categories = array();
    foreach ($input->categories as $value) {
      array_push($categories, array('creditId'=>$insert_id, 'categoryId'=>$value));
    }

    $this->db->insert_batch('credits_categories',$categories);
    
    $response = new stdClass();
    $response->credits = $this->db->get("credits")->result();
    $response->msj = 'State created successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('credits', $input, array('id'=>$id));
  
    $response = new stdClass();
    $response->credits = $this->db->get("credits")->result();
    $response->msj = 'State updated successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {

    
    $this->db->delete('credits', array('id'=>$id));
      
    $response = new stdClass();
    $response->credits = $this->db->get("credits")->result();
    $response->msj = 'State deleted successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }  	
}