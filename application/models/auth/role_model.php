<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model{
	
	private $table = 'mp_role';
	
	public function __construct() {
		$this->load->database();
	}
	
	public function get_roles() {
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function update_role($data) {
		$this->db->set('rolename', $data['rolename']);
		$this->db->set('status', $data['roleStatus']);
		$this->db->where('id', $data['roleId']);
		$this->db->update($this->table);
		
		return $this->db->affected_rows();
	}
	
	public function add_role($data) {
		
		$this->db->insert($this->table, $data);
	
		return $this->db->affected_rows();
	}
	
	public function delete_role($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		echo $this->db->last_query();
		return $this->db->affected_rows();
	}
}
