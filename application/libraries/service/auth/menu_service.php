<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/menu_model');
	}
	
	public function get_menus() {
		$res = $this->CI->menu_model->get_menus();
		return $res;
	}
}
 