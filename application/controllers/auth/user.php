<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'service/auth/user_service' );
		$this->load->library ( 'service/auth/menu_service' );
		$this->load->library ( 'service/auth/role_service' );
		$this->load->library ( 'service/auth/node_service' );
		$this->load->library ( 'auth_filter' );
		$this->load->helper ( 'qizhuan_helper' );
	}
	
	public function getUser() {
		$this->auth_filter->check_auth ();
		$username = $this->session->userdata('username');
		$userid = $this->session->userdata('userid');
		$roleid = $this->session->userdata('roleid');
		
		$res = array(
				'username' => $username,
				'userid' => $userid,
				'roleid' => $roleid,
		);
		$this->output
			->set_content_type ( 'application/json' )
			->set_output ( data_format ( TRUE, $res, '' ) );
		return TRUE;
	}
}

