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
      $data = $this->db->get_where("credits", ['id' => $id])->result();
    } else {
      $data = $this->db->get("credits")->result();
    }

    $result=array();

    if (!empty($data)) {
      foreach ($data as $v) {
        $tmp = array();
        $tmp['id']=$v->id;
        $tmp['nameES']=$v->nameES;
        $tmp['nameEN']=$v->nameEN;
        $tmp['active']=$v->active;
        $tmp['askAlways']=$v->questionES;
        $tmp['questionEN']=$v->askAlways;
        $tmp['questionES']=$v->questionEN;
        $tmp['maxAmount']=$v->maxAmount;
        $tmp['minAmount']=$v->minAmount;
        $tmp['slug']=$v->slug;
        $tmp['created_at']=$v->created_at;
        $tmp['updated_at']=$v->updated_at;
        
        $tmp['categories']=array();
        $categories = $this->db->get_where("credits_categories", ['creditId' => $v->id])->result();
        if (!empty($categories))
          foreach ($categories as $c) {

            array_push($tmp['categories'],$c->categoryId);
          }
          $result[]=$tmp;
        }
      }

      $this->response($result, REST_Controller::HTTP_OK);
    }

    public function index_post(){
      $input = json_decode($this->input->raw_input_stream);

    //prepare array for credits
      $credit = array(
        'nameES'=>$input->nameES, 
        'nameEN'=>$input->nameEN, 
        'askAlways'=>$input->questionES, 
        'questionEN'=>$input->askAlways, 
        'questionES'=>$input->questionEN, 
        'maxAmount'=>$input->maxAmount, 
        'minAmount'=>$input->minAmount, 
        'slug'=>$input->slug, 
        'active'=>1 
      );

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
      $response->success = true;
      $result=array();
      $data = $this->db->get("credits")->result();
      if (!empty($data)) {
        foreach ($data as $v) {
          $tmp = array();
          $tmp['id']=$v->id;
          $tmp['nameES']=$v->nameES;
          $tmp['nameEN']=$v->nameEN;
          $tmp['active']=$v->active;
          $tmp['askAlways']=$v->askAlways;
          $tmp['questionES']=$v->questionES;
          $tmp['questionEN']=$v->questionEN;
          $tmp['maxAmount']=$v->maxAmount;
          $tmp['minAmount']=$v->minAmount;
          $tmp['created_at']=$v->created_at;
          $tmp['updated_at']=$v->updated_at;

          $tmp['categories']=array();
          $categories = $this->db->get_where("credits_categories", ['creditId' => $v->id])->result();
          if (!empty($categories))
            foreach ($categories as $c) {

              array_push($tmp['categories'],$c->categoryId);
            }
            $result[]=$tmp;
          }
        }

        $response->credits = $result;
        $response->msj = 'State created successfully.';
        $this->response($response, REST_Controller::HTTP_OK);
      } 

      public function index_put($id) {
        $input = $this->put();
        $input['updated_at'] = date("Y-m-d h:i:s");

        if(isset($input['categories'])) {$categories = $input['categories'];}else{$categories=null;}

        unset($input['categories']);

        $this->db->update('credits', $input, array('id'=>$id));



        $_categories = array();
        if (!is_null($categories)){

          if($this->db->get_where("credits_categories", ['creditId' => $id])->result()){
            $this->db->delete('credits_categories', array('creditId'=>$id));
          }
          
          foreach ($categories as $v) {
            array_push($_categories, array('creditId'=>$id, 'categoryId' => $v ));
          }

          $this->db->insert_batch('credits_categories', $_categories);
        }

        $response = new stdClass();
        $response->success = true;
        $result=array();
        $data = $this->db->get("credits")->result();
        if (!empty($data)) {
          foreach ($data as $v) {
            $tmp = array();
            $tmp['id']=$v->id;
            $tmp['nameES']=$v->nameES;
            $tmp['nameEN']=$v->nameEN;
            $tmp['active']=$v->active;
            $tmp['askAlways']=$v->askAlways;
            $tmp['questionES']=$v->questionES;
            $tmp['questionEN']=$v->questionEN;
            $tmp['maxAmount']=$v->maxAmount;
            $tmp['minAmount']=$v->minAmount;
            $tmp['slug']=$v->slug;
            $tmp['created_at']=$v->created_at;
            $tmp['updated_at']=$v->updated_at;

            $tmp['categories']=array();
            $categories = $this->db->get_where("credits_categories", ['creditId' => $v->id])->result();
            if (!empty($categories))
              foreach ($categories as $c) {

                array_push($tmp['categories'],$c->categoryId);
              }
              $result[]=$tmp;
            }
          }

          $response->credits = $result;
          $response->msj = 'State updated successfully.';
          $this->response($response, REST_Controller::HTTP_OK);
        }


        public function index_delete($id) {
          if($this->db->get_where("credits_categories", ['creditId' => $id])->result()){
            $this->db->delete('credits_categories', array('creditId'=>$id));
          }
          $this->db->delete('credits', array('id'=>$id));

          $response = new stdClass();
          $response->success = true;
          $response->credits = $this->db->get("credits")->result();

          $result=array();
          $data = $this->db->get("credits")->result();
          if (!empty($data)) {
            foreach ($data as $v) {
              $tmp = array();
              $tmp['id']=$v->id;
              $tmp['nameES']=$v->nameES;
              $tmp['nameEN']=$v->nameEN;
              $tmp['active']=$v->active;
              $tmp['askAlways']=$v->askAlways;
              $tmp['questionES']=$v->questionES;
              $tmp['questionEN']=$v->questionEN;
              $tmp['maxAmount']=$v->maxAmount;
              $tmp['minAmount']=$v->minAmount;
              $tmp['slug']=$v->slug;
              $tmp['created_at']=$v->created_at;
              $tmp['updated_at']=$v->updated_at;

              $tmp['categories']=array();
              $categories = $this->db->get_where("credits_categories", ['creditId' => $v->id])->result();
              if (!empty($categories))
                foreach ($categories as $c) {

                  array_push($tmp['categories'],$c->categoryId);
                }
                $result[]=$tmp;
              }
            }

            $response->credits = $result;
            $response->msj = 'Credit deleted successfully.';
            $this->response($response, REST_Controller::HTTP_OK);
          }  	
        }