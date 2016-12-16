<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class AdminUser extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'service/auth/admin_user_service' );
		$this->load->library ( 'service/auth/menu_service' );
		$this->load->library ( 'service/auth/role_service' );
		$this->load->library ( 'service/auth/node_service' );
		$this->load->library ( 'auth_filter' );
		$this->load->helper ( 'qizhuan_helper' );
        $this->load->library('pagination');
        $this->auth_filter->check_auth ();
	}
	
	public function getAdminUser() {
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

	public function adminUsers() {
	    $config['base_url'] = 'http://qizhuan.powersoft.com/auth/adminUser/adminUsers';
	    $config['total_rows'] = 200;
	    $config['per_page'] = 3;
	    $this->pagination->initialize($config);
	   // echo $this->pagination->create_links();

	   $res = $this->admin_user_service->get_admin_users($_REQUEST);
	   $this->output
           ->set_content_type('application/json')
           ->set_output(page_data_format(TRUE, $res, ''));
	   return TRUE;
    }
}

