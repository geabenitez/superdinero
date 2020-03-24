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
    $this->response(getPartners($id), REST_Controller::HTTP_OK);
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
    $input->characteristicsES = implode("-&-", $input->characteristicsES);

    foreach ($input->characteristicsEN as $key => $value) {$value="'".$value."'";}
    $input->characteristicsEN = implode("-&-", $input->characteristicsEN);

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

    $partner_methods = [];
    foreach ($methods as $value) {
      array_push($partner_methods, array(
        'partnerId' => $partnerId,
        'methodId' => $value
      ));
    }
    $this->db->insert_batch('partners_methods', $partner_methods);


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


    $partners = getPartners(0);


    $response = new stdClass();
    $response->partners = $partners;
    $response->msj = 'Partner created successfully.';
    $response->success = true;
    $this->response($response, REST_Controller::HTTP_OK);


  } 

  public function index_put($id) {
    $input = json_decode($this->input->raw_input_stream);

    if (!isset($input->nameES)) {
      $data = array('active' => $input->active);
      $this->db->update('partners', $data, array('id'=>$id));

      $response = new stdClass();
      $response->partners = getPartners(0);
      $response->msj = 'Partner updated successfully.';
      $response->success = true;

      $this->response($response, REST_Controller::HTTP_OK);
      return;
    }

    $categories = $input->categories;
    $states = $input->states;
    $amounts = $input->amounts;
    $records = $input->records;
    $methods = $input->methods;
    $credits = $input->credits;
    $documents = $input->documents;

    unset($input->categories, $input->states, $input->amounts, $input->records, $input->methods, $input->credits, $input->documents);
    
    foreach ($input->characteristicsES as $key => $value) {$value="'".$value."'";}
    $input->characteristicsES = implode("-&-", $input->characteristicsES);

    foreach ($input->characteristicsEN as $key => $value) {$value="'".$value."'";}
    $input->characteristicsEN = implode("-&-", $input->characteristicsEN);


    $input->updated_at = date("Y-m-d h:i:s");
    $this->db->update('partners', $input, array('id'=>$id));




    if($this->db->get_where("partners_categories", ['partnerId' => $id])->result()){
      $this->db->delete('partners_categories', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_states", ['partnerId' => $id])->result()){
      $this->db->delete('partners_states', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_amounts", ['partnerId' => $id])->result()){
      $this->db->delete('partners_amounts', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_records", ['partnerId' => $id])->result()){
      $this->db->delete('partners_records', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_methods", ['partnerId' => $id])->result()){
      $this->db->delete('partners_methods', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_credits", ['partnerId' => $id])->result()){
      $this->db->delete('partners_credits', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_documents", ['partnerId' => $id])->result()){
      $this->db->delete('partners_documents', array('partnerId'=>$id));
    }



    
    $partnerId = $id;

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

    $partner_methods = [];
    foreach ($methods as $value) {
      array_push($partner_methods, array(
        'partnerId' => $partnerId,
        'methodId' => $value
      ));
    }
    $this->db->insert_batch('partners_methods', $partner_methods);


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






    $response = new stdClass();
    $response->partners = getPartners(0);

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

    if($this->db->get_where("partners_records", ['partnerId' => $id])->result()){
      $this->db->delete('partners_records', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_credits", ['partnerId' => $id])->result()){
      $this->db->delete('partners_credits', array('partnerId'=>$id));
    }

    if($this->db->get_where("partners_documents", ['partnerId' => $id])->result()){
      $this->db->delete('partners_documents', array('partnerId'=>$id));
    }

    $this->db->delete('partners', array('id'=>$id));



    $response = new stdClass();
    $response->partners = getPartners(0);


    $response->success = true;
    $response->msj = 'Partners deleted successfully.';
    $this->response($response, REST_Controller::HTTP_OK);

  }  	



}