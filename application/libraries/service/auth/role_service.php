<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 角色
 * @author qiaoyi
 *
 */
class Role_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/role_model');
		$this->CI->load->helper('mp_helper');
		$this->CI->load->library('log_service');
	}
	
	//获取所有角色
	public function get_roles() {
	    $this->CI->log_service->info('get all role');
		$res = $this->CI->role_model->get_roles();
		return $res;
	}
	
	//更新角色
	public function update_role($data) {
		if(empty($data['roleId'])) {
			$res = rtn_json('failed', '2', 'roleid is null');
			$this->CI->log_service->error('roleid is null');
		} else {
			$res = $this->CI->role_model->update_role($data);
			if($res > 0) {
				$res = rtn_json('success', '', '');
			}
		}
		return $res;
	}
	
	//添加角色
	public function add_role($data) {
		$rolename = $data['rolename'];
		$status = $data['roleStatus'];
		$arrRole = array(
				'rolename' => $rolename,
				'status' => $rolename
		);
		if(empty($rolename)) {
			$res = rtn_json('failed', '3', 'roleid is null');
            $this->CI->log_service->error('roleid is null');
		} else {
			$res = $this->CI->role_model->add_role($arrRole);
			if($res > 0) {
				$res = rtn_json('success', '', '');
			}
		}
		return $res;
	}
	
	//删除角色
	public function delete_role($data) {
		if(empty($data['roleId'])) {
			$res = rtn_json('failed', '2', 'roleid is null');
            $this->CI->log_service->error('roleid is null');
		} else {
			$res = $this->CI->role_model->delete_role($data['roleId']);
			if($res > 0) {
				$res = rtn_json('success', '', '');
			}
		}
		return $res;
	}
}
 
