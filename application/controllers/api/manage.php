<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Manage extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'service/auth/admin_user_service' );
		$this->load->library ( 'service/auth/menu_service' );
		$this->load->library ( 'service/auth/role_service' );
		$this->load->library ( 'service/auth/node_service' );
		$this->load->library ( 'auth_filter' );
		$this->load->helper ( 'mp_helper' );
	}
	public function index() {
		$this->auth_filter->check_auth ();
		$this->load->view ( 'index' );
	}


}

