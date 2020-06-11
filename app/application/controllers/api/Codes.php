<?php
require APPPATH . 'libraries/REST_Controller.php';

class Codes extends REST_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$enc = getallheaders();

		if (!isset($enc['token-crf'])) {
			$this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
			echo json_encode(array('mensaje' => 'Sin acceso'));
			die();
		} else if ($enc['token-crf'] != '$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K') {
			$this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
			echo json_encode(array('mensaje' => 'Token no valido'));
			die();
		}
	}

	public function index_get($id = 0)
	{
		$this->response(getCodes($id), REST_Controller::HTTP_OK);
	}

	public function index_post()
	{


		if ($this->input->get('fr') == 'nodial') {
			if (is_null($this->session->userdata('id'))) {
				$this->response(['Sin autorización'], REST_Controller::HTTP_UNAUTHORIZED);
				die();
			}
		}

		$YEAR = array("2020" => "A", "2021" => "B", "2022" => "C", "2023" => "D", "2024" => "F", "2025" => "G", "2026" => "H", "2027" => "I", "2028" => "J", "2029" => "K", "2030" => "L", "2031" => "M", "2032" => "N", "2033" => "O", "2034" => "P", "2035" => "Q", "2036" => "R", "2037" => "S", "2038" => "T", "2039" => "U", "2040" => "V", "2041" => "W", "2042" => "X", "2043" => "Y", "2044" => "Z");
		$MONTH = array("1" => "A", "2" => "B", "3" => "C", "4" => "D", "5" => "F", "6" => "G", "7" => "H", "8" => "I", "9" => "J", "10" => "K", "11" => "L", "12" => "M");

		$vigente = $YEAR[date('Y')] . $MONTH[date('n')];
		$result = $this->db->query("select max(codigo) code from codes where codigo like '%" . $vigente . "%'")->result();

		$new_code = "";
		if (empty($result[0]->code)) {
			$new_code = $vigente . "10000";
		} else {
			$data =  substr($result[0]->code, 2, strlen($result[0]->code));
			$new_code = $vigente . ($data + 1);
		}

		$input = json_decode($this->input->raw_input_stream);
		$conf = $input->configuracion;

		$code_user = null;
		$get_code_user = $this->db->query("select max(code) code from users where id = '" . $this->session->userdata('id') . "'")->result();
		if (!empty($get_code_user[0]->code)) {
			$code_user = $get_code_user[0]->code;
		}

		$insert = array(
			'agent' => $this->session->userdata('id'),
			'codigo' => $new_code,
			'configuracion' => json_encode($input->configuracion),
			'created_at' => date("Y-m-d h:i:s")

		);



		//********************** Inicio de proceso de consumo de API *************************************************
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://app.calltools.com/api/contacts/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => array(
				"phone_number" => "1" . $conf->phone,
				"email_address" => $conf->email,
				"first_name" => $conf->names,
				"last_name" => $conf->lastnames,
				"custom1" => ((isset($conf->source)) ? $conf->source : "null"),
				"custom2" => $code_user,
				"file" => $this->input->get('fr') == 'nodial' ? "756822" : "757229",
				"dial_duplicate" => 1,
				"company_name" => 'https://app.superdinero.org/check?code=' . $new_code
			),
			CURLOPT_HTTPHEADER => array(
				"Authorization: Token 3924c585adc3984c10f613dd2de7f36d79e668e9"
			),
		));

		$response = curl_exec($curl);
		// var_dump($response);

		curl_close($curl);
		//********************** FIN de proceso de consumo de API *************************************************


		$this->db->insert('codes', $insert);
		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes created successfully.';
		$response->code = $new_code;
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function index_put($id)
	{
		$input = $this->put();
		$input['updated_at'] = date("Y-m-d h:i:s");
		$this->db->update('codes', $input, array('id' => $id));

		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes updated successfully.';
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function index_delete($id)
	{
		$this->db->delete('codes', array('id' => $id));

		$response = new stdClass();
		$response->codes = $this->db->get("codes")->result();
		$response->msj = 'Codes deleted successfully.';
		$response->success = true;
		$this->response($response, REST_Controller::HTTP_OK);
	}
}
