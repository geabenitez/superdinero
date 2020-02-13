<?php
require APPPATH . 'libraries/REST_Controller.php';

class Partner extends REST_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $enc = getallheaders();

    if (!isset($enc['token-crf'])) {
      $this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
      echo json_encode( array('mensaje'=>'Sin acceso' ) );
      die();
    }else if($enc['token-crf']!='$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K') {
      $this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
      echo json_encode( array('mensaje'=>'Token no valido' ) );
      die();
    }
  }

	public function index_get($id = 0){
    if (!empty($id)) {
      $partners = $this->db->get_where("partners", ['id' => $id])->row_array();
    } else {
      $partners = $this->db->get("partners")->result();
    }
    foreach ($partners as $key => $value) {
      $c = "categories";
      $pc = "partners_categories";
      $s = "states";
      $ps = "partners_states";
      $getCategories = array(
        $c.'.nameES',
        $c.'.nameEN',
        $c.'.image'
      );
      $getStates = array(
        $s.'.nameES',
        $s.'.nameEN',
      );
      $value->categories = $this->db
        ->select($getCategories)
        ->from($pc)
        ->where($pc.'.partnerId', $value->id)
        ->join($c, $c.'.id = ' . $pc . '.categoryId', 'right')
        ->get()->result();
      $value->states = $this->db
        ->select($getStates)
        ->from($ps)
        ->where($ps.'.partnerId', $value->id)
        ->join($s, $s.'.id = ' . $ps . '.stateId', 'right')
        ->get()->result();
    }
    $this->response($partners, REST_Controller::HTTP_OK);
  }

  public function index_post(){
    $input = $this->input->post();
    $categories = $input["categories"];
    $states = $input["states"];
    $amounts = $input["amounts"];
    unset($input["categories"], $input["states"], $input["amounts"]);

    $this->db->insert('partners',$input);
    $partnerId = $this->db->insert_id();

    $partner_categories = [];
    foreach (explode(",", $categories) as $value) {
      array_push($partner_categories, array(
        'partnerId' => $partnerId,
        'categoryId' => $value
      ));
    }
    $this->db->insert_batch('_partners_categories', $partner_categories);

    $partner_states = [];
    foreach (explode(",", $states) as $value) {
      array_push($partner_states, array(
        'partnerId' => $partnerId,
        'stateId' => $value
      ));
    }
    $this->db->insert_batch('_partners_states', $partner_states);

    $partner_amounts = [];
    foreach (explode(",", $amounts) as $value) {
      array_push($partner_amounts, array(
        'partnerId' => $partnerId,
        'amountId' => $value
      ));
    }
    $this->db->insert_batch('_partners_amounts', $partner_amounts);

    $response = new stdClass();
    $response->partners = $this->db->get("partners")->result();
    $response->msj = 'Category created successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('partners', $input, array('id'=>$id));
  
    $response = new stdClass();
    $response->partners = $this->db->get("partners")->result();
    $response->msj = 'Category updated successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {
    $this->db->delete('partners', array('id'=>$id));
      
    $response = new stdClass();
    $response->partners = $this->db->get("partners")->result();
    $response->msj = 'Category deleted successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }  	
}