<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/node_model');
	}
	
	public function get_nodes() {
		$res = $this->CI->node_model->get_nodes();
		return $res;
	}
}
 