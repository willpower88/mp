<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Menu extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'service/auth/admin_user_service' );
		$this->load->library ( 'service/auth/menu_service' );
		$this->load->library ( 'service/auth/role_service' );
		$this->load->library ( 'service/auth/node_service' );
		$this->load->library ( 'auth_filter' );
		$this->load->helper ( 'mp_helper' );
	}
	
	public function menus() {
		$res = $this->menu_service->menus ( $_REQUEST );
        $this->output->set_content_type ( 'application/json' )->set_output ( data_format(true, $res, ''));
		return TRUE;
	}
}

