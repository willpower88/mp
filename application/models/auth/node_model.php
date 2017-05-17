<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_model extends CI_Model{
	public function __construct() {
		$this->load->database();
	}
	
	public function get_nodes() {
		$query = $this->db->get('mp_node');
		return $query->row_array();
	}
}
