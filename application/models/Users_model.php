<?php 
class Users_model extends CI_Model {

	public function login($correo, $password) {


		$this->db->select('*');
		$this->db->from('Users');
		$this->db->where('correo', $correo);
		$result = $this->db->get()->result();

		$return = new stdClass();
		if (count($result) > 0) {
			if (password_verify($password, $result[0]->password)) {
				$return->msj = 'Iniciando sesión';
				$return->success = true;
				$msj=array('exito'=>1,'mensaje'=>'Bienvenido '.$result[0]->nombre);
				$this->session->set_userdata('logged', true);
				$this->session->set_userdata('id', $result[0]->id);
				$this->session->set_userdata('email', $result[0]->email);
				$this->session->set_userdata('names', $result[0]->names);
				$this->session->set_userdata('lastnames', $result[0]->lastnames);
				$this->session->set_userdata('code', $result[0]->code);


				$return->msj = 'Bienvenido';
				$return->success = true;
				$return->id = $result[0]->id;
				$return->email = $result[0]->email;
				$return->names = $result[0]->names;
				$return->lastnames = $result[0]->lastnames;
				$return->code = $result[0]->code;

			}else{
				
				$return->msj = 'Contraseña incorrecta';
				$return->success = false;
			}
		} else {
			$msj=array('exito'=>0,'mensaje'=>'Usuario no registrado');
			$return->msj = 'Usuario incorrecto';
			$return->success = false;
		}
        
        return json_encode((object) array("result" => $return));
		
	}
}
?>