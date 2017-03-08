<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Role extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'service/auth/admin_user_service' );
		$this->load->library ( 'service/auth/menu_service' );
		$this->load->library ( 'service/auth/role_service' );
		$this->load->library ( 'service/auth/node_service' );
		$this->load->library ( 'auth_filter' );
		$this->load->helper ( 'mp_helper' );
	}
	
	public function authManage() {
		$this->load->view ( 'auth_manage' );
	}
	
	public function user() {
		$this->auth_filter->check_auth ();
		$res = $this->user_service->get_users ();
		$this->output->set_content_type ( 'application/json' )->set_output ( data_format ( TRUE, $res, '' ) );
		return TRUE;
	}
	public function menu() {
		$res = $this->menu_service->get_menus ();
		$this->output->set_content_type ( 'application/json' )->set_output ( data_format ( TRUE, $res, '' ) );
		return TRUE;
	}
	public function role() {
		$res = $this->role_service->get_roles ();
		$this->output->set_content_type ( 'application/json' )->set_output ( data_format ( TRUE, $res, '' ) );
		return TRUE;
	}
	public function node() {
		$res = $this->node_service->get_nodes ();
		$this->output->set_content_type ( 'application/json' )->set_output ( data_format ( TRUE, $res, '' ) );
		return TRUE;
	}
	public function roleModify() {
		$res = $this->role_service->update_role ( $_REQUEST );
		$this->output->set_content_type ( 'application/json' )->set_output ( $res );
		return TRUE;
	}
	public function roleAdd() {
		$res = $this->role_service->add_role ( $_REQUEST );
		$this->output->set_content_type ( 'application/json' )->set_output ( $res );
		return TRUE;
	}
	public function roleDelete() {
		$res = $this->role_service->delete_role ( $_REQUEST );
		$this->output->set_content_type ( 'application/json' )->set_output ( $res );
		return TRUE;
	}
}

