<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Admin_user_model extends CI_Model {
	private $table_admin_user = 'mp_admin_user';
	private $table_role = 'mp_role';
	public function __construct() {
		$this->load->database ();
		$this->load->library('log_service');
	}
	public function get_admin_users($idx = 0, $offset = 0, $isCount = false) {
        $query = array();
        $sql = '';
        $sql_data = array();
	    if($isCount) {
	        $this->db->select('count(1) as count');
	        $this->db->from($this->table_admin_user . ' as a');
	        $this->db->join($this->table_role . ' as b', 'a.role_id = b.id', 'left');
        } else{
            $this->db->select('a.*, b.rolename');
            $this->db->from($this->table_admin_user . ' as a');
            $this->db->join($this->table_role . ' as b', 'a.role_id = b.id', 'left');
            $this->db->order_by('a.id');
            $this->db->limit($offset, $idx);
        }
        $query = $this->db->get();
        $this->log_service->debug($this->db->last_query());
		return $query->result_array ();
	}
	public function get_admin_user_by_username($username) {
		if (empty ( $username )) {
			return array ();
		}
		
		$this->db->select ( 'id,username,password,nickname,email,role_id,status' );
		$this->db->from ( $this->table_admin_user );
		$this->db->where ( 'username', $username );
		$res = $this->db->get ();
		if (! $res) {
			return array ();
		}
		return $res->result_array ();
	}
	public function update_admin_user_by_id($userid, $data) {
		if (empty ( $userid ) || empty ( $data )) {
			return FALSE;
		}
		$this->db->where ( "id", $userid );
		return $this->db->update ( $this->table_admin_user, $data );
	}
}
