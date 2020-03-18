<?php
require APPPATH . 'libraries/REST_Controller.php';

class Codes extends REST_Controller {

	
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
		$this->response(getCodes($id), REST_Controller::HTTP_OK);
	}

	public function index_post(){

		$YEAR = array("2020"=>"A", "2021"=>"B", "2022"=>"C", "2023"=>"D", "2024"=>"F", "2025"=>"G", "2026"=>"H", "2027"=>"I", "2028"=>"J", "2029"=>"K", "2030"=>"L", "2031"=>"M", "2032"=>"N", "2033"=>"O", "2034"=>"P", "2035"=>"Q", "2036"=>"R", "2037"=>"S", "2038"=>"T", "2039"=>"U", "2040"=>"V", "2041"=>"W", "2042"=>"X", "2043"=>"Y", "2044"=>"Z");

		$MONTH = array("1"=>"A", "2"=>"B", "3"=>"C", "4"=>"D", "5"=>"F", "6"=>"G", "7"=>"H", "8"=>"I", "9"=>"J", "10"=>"K", "11"=>"L", "12"=>"M");

		$vigente = $YEAR[date('Y')].$MONTH[date('n')];
		$result = $this->db->query("select max(codigo) code from codes where codigo like '%".$vigente."%'")->result();

		$new_code = "";
		if (empty($result[0]->code)) {
			$new_code = $vigente."10000";
		}else{
		//$data =  explode('-',$result[0]->code);
			$data =  substr($result[0]->code,2,strlen($result[0]->code));
			$new_code = $vigente.($data+1);
		}

		$input = json_decode($this->input->raw_input_stream);
		$conf = $input->configuracion;

		$code_user = null;
		$get_code_user = $this->db->query("select max(code) code from users where id = '".$input->agent."'")->result();
		if (!empty($get_code_user[0]->code)) {
			$code_user = $get_code_user[0]->code;
		}

		$insert = array(
			'agent'=>$code_user,
			'codigo'=>$new_code,
			'configuracion'=>json_encode($input->configuracion),
			'created_at' => date("Y-m-d h:i:s")

		);

		

	//********************** Inicio de proceso de consumo de API *************************************************
		$form_url = "https://api.calltrackingmetrics.com/api/v1/formreactor/FRT472ABB2C5B9B141A0B4FB298C41D61940F328C0FD82EDFB20D301E6E28830BD9";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$form_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		$post_fields = [
			"phone_number" => "+1".$conf->phone,
			"email" => $conf->email,
			"caller_name" => $conf->names." ".$conf->lastnames,
			"custom_source" => "null",
			"custom_agent" => $input->agent
		];

		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
			'Authorization: Basic YTIxMjAwNGQ0MDZlZWRiNTU0YjNkOWIzYWZjN2IxYjZiY2Q2Y2ViNDphZjIxYjNjMGY5MTI4MDI1MmIwY2IyNGMyNGFiZjZjYmYwYjY='
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

	//********************** FIN de proceso de consumo de API *************************************************


		$this->db->insert('codes',$insert);
		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes created successfully.';
		$response->code = $new_code;
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);

	} 

	public function index_put($id) {
		$input = $this->put();
		$input['updated_at'] = date("Y-m-d h:i:s");
		$this->db->update('codes', $input, array('id'=>$id));

		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes updated successfully.';
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function index_delete($id) {
		$this->db->delete('codes', array('id'=>$id));

		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes deleted successfully.';
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);
	}  



}






