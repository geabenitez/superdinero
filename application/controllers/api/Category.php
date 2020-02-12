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
    $input = json_decode($this->input->raw_input_stream);
    var_dump($this->input->post());
    var_dump($_POST);
    

    //*************SUBIENDO ARCHIVO**********************
    $config['upload_path']          = './media/';
    $config['overwrite']          = true;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']        = md5("nombre");
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;
    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('image'))
    {
      //NO SE SUBIO
    }else{
      //SI SE SUBIO
      $info = $this->upload->data();//la informacion del archivo subido

    }
    //*************FIN SUBIENDO ARCHIVO**********************


    $this->db->insert('categories',$input);
    $response = new stdClass();
    $response->categories = $this->db->get("categories")->result();
    $response->msj = 'Category created successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  } 

  public function index_put($id) {
    $input = $this->put();
    $input['updated_at'] = date("Y-m-d h:i:s");
    $this->db->update('categories', $input, array('id'=>$id));
  
    $response = new stdClass();
    $response->categories = $this->db->get("categories")->result();
    $response->msj = 'Category updated successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }

  public function index_delete($id) {
    $this->db->delete('categories', array('id'=>$id));
      
    $response = new stdClass();
    $response->categories = $this->db->get("categories")->result();
    $response->msj = 'Category deleted successfully.';
    $this->response($response, REST_Controller::HTTP_OK);
  }  	
}