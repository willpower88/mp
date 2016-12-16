<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_model extends CI_Model {
	private $table_name = 'qizhuan_user';
	public function __construct() {
		$this->load->database ();
	}
	public function get_users() {
		$query = $this->db->get ( 'qizhuan_user' );
		return $query->row_array ();
	}
	public function get_user_by_username($username) {
		if (empty ( $username )) {
			return array ();
		}
		
		$this->db->select ( 'id,username,password,nickname,email,role_id,status' );
		$this->db->from ( $this->table_name );
		$this->db->where ( 'username', $username );
		$res = $this->db->get ();
		if (! $res) {
			return array ();
		}
		return $res->result_array ();
	}
	public function update_user_by_id($userid, $data) {
		if (empty ( $userid ) || empty ( $data )) {
			return FALSE;
		}
		$this->db->where ( "id", $userid );
		return $this->db->update ( $this->table_name, $data );
	}
}