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
        $c.'.nameEN'
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
    $input = json_decode($this->input->raw_input_stream);


    $categories = $input->categories;
    $states = $input->states;
    $amounts = $input->amounts;
    $records = $input->records;
    $credits = $input->credits;
    $documents = $input->documents;

    unset($input->categories, $input->states, $input->amounts, $input->records, $input->credits, $input->documents);

    
    foreach ($input->characteristicsES as $key => $value) {$value="'".$value."'";}
    $input->characteristicsES = implode(",", $input->characteristicsES);

    foreach ($input->characteristicsEN as $key => $value) {$value="'".$value."'";}
    $input->characteristicsEN = implode(",", $input->characteristicsEN);

    $this->db->insert('partners',$input);
    $partnerId = $this->db->insert_id();

    $partner_categories = [];
    foreach ($categories as $value) {
      array_push($partner_categories, array(
        'partnerId' => $partnerId,
        'categoryId' => $value
      ));
    }
    $this->db->insert_batch('partners_categories', $partner_categories);


    $partner_records = [];
    foreach ($records as $value) {
      array_push($partner_records, array(
        'partnerId' => $partnerId,
        'recordId' => $value
      ));
    }
    $this->db->insert_batch('partners_records', $partner_records);


    $partner_credits = [];
    foreach ($credits as $value) {
      array_push($partner_credits, array(
        'partnerId' => $partnerId,
        'creditsId' => $value
      ));
    }
    $this->db->insert_batch('partners_credits', $partner_credits);


    $partner_documents = [];
    foreach ($documents as $value) {
      array_push($partner_documents, array(
        'partnerId' => $partnerId,
        'documentId' => $value
      ));
    }
    $this->db->insert_batch('partners_documents', $partner_documents);








    $partner_states = [];
    foreach ($states as $value) {
      array_push($partner_states, array(
        'partnerId' => $partnerId,
        'stateId' => $value
      ));
    }
    $this->db->insert_batch('partners_states', $partner_states);

    $partner_amounts = [];
    foreach ($amounts as $value) {
      array_push($partner_amounts, array(
        'partnerId' => $partnerId,
        'amountId' => $value
      ));
    }
    $this->db->insert_batch('partners_amounts', $partner_amounts);




    $partners = $this->db->get("partners")->result();

    foreach ($partners as $key => $value) {
      $c = "categories";
      $pc = "partners_categories";
      $s = "states";
      $ps = "partners_states";
      $getCategories = array(
        $c.'.nameES',
        $c.'.nameEN'
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
  



    $response = new stdClass();
    $response->partners = $partners;
    $response->msj = 'Partner created successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);





  } 

  public function index_put($id) {
    $input = $this->put();

    if (isset($input['active'])) {
      $data = array('active' => $input['active'] );
      $this->db->update('partners', $data, array('id'=>$id));

      $response = new stdClass();
      $response->partners = $this->db->get("partners")->result();
      foreach ($response->partners as $key => $value) {
      $c = "categories";
      $pc = "partners_categories";
      $s = "states";
      $ps = "partners_states";
      $getCategories = array(
        $c.'.nameES',
        $c.'.nameEN'
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
      $response->msj = 'Partner updated successfully.';
      $response->success = true;
     
      $this->response($response, REST_Controller::HTTP_OK);
      return;
    }

    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('partners', $input, array('id'=>$id));

    $response = new stdClass();
    $response->partners = $this->db->get("partners")->result();
    $response->msj = 'Partner updated successfully.';
    $response->success = true;

    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {

    if($this->db->get_where("partners_categories", ['partnerId' => $id])->result()){
      $this->db->delete('partners_categories', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_states", ['partnerId' => $id])->result()){
      $this->db->delete('partners_states', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_amounts", ['partnerId' => $id])->result()){
      $this->db->delete('partners_amounts', array('partnerId'=>$id));
    }

    $this->db->delete('partners', array('id'=>$id));



    $response = new stdClass();
    $response->partners = $this->db->get("partners")->result();


    $partners = $this->db->get("partners")->result();
    foreach ($partners as $key => $value) {
      $c = "categories";
      $pc = "partners_categories";
      $s = "states";
      $ps = "partners_states";
      $getCategories = array(
        $c.'.nameES',
        $c.'.nameEN'
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
    $response->success = true;
    $response->partners = $partners;
    $response->msj = 'Partners deleted successfully.';
    $this->response($response, REST_Controller::HTTP_OK);

  }  	
}