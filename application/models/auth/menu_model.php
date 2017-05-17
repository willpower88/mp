<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{
	public function __construct() {
		$this->load->database();
	}
	
	public function get_menus() {
		$query = $this->db->get('mp_menu');
		return $query->row_array();
	}
}
