<?php 
class Users_model extends CI_Model {

	public function login($email, $password) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$result = $this->db->get()->result();
		

		$return = new stdClass();
		$return->msj = 'Email or password not valid';
		$return->success = false;
		if (count($result) > 0) {
			if (password_verify($password, $result[0]->password)) {
				$this->session->set_userdata('logged', true);
				$this->session->set_userdata('id', $result[0]->id);
				$this->session->set_userdata('email', $result[0]->email);
				$this->session->set_userdata('names', $result[0]->names);
				$this->session->set_userdata('lastnames', $result[0]->lastnames);
				$this->session->set_userdata('code', $result[0]->code);

				$return->msj = 'Loggin in';
				$return->success = true;
				$return->id = $result[0]->id;
				$return->email = $result[0]->email;
				$return->names = $result[0]->names;
				$return->lastnames = $result[0]->lastnames;
				$return->code = $result[0]->code;

			}
		} 
		return json_encode((object) array("result" => $return));

	}
}
?>