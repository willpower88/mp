<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
		$this->load->library('service/auth/admin_user_service');
		$this->load->library('auth_filter');
		$this->load->helper('mp_helper');
	}
	
	public function index(){
	    echo 'aaaa';die;
		$this->load->view('login');
	}
	
	public function login() {
		$rst = $this->admin_user_service->check_admin_user($_REQUEST);
		if($rst['status'] == 'failed') {
			echo json_encode($rst);
		}
		$res = $this->admin_user_service->login($_REQUEST['username'], $_REQUEST['password']);
		//echo json_encode($res);
		$this->load->view('index');
		return TRUE;
	}	
	
	
}

