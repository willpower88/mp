<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sell_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/node_model');
	}
	
}
 