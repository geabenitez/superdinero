<?php 
	class Admin_model extends CI_Model {
		
		public function get_last_ten_entries() {
			$query = $this->db->get('entries', 10);
			return $query->result();
		}
	}
?>