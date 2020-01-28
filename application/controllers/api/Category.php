<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Category extends REST_Controller {
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