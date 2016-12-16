<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台用户
 * @author qiaoyi
 *
 */
class User_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/user_model');
		$this->CI->load->helper('qizhuan_helper');
		$this->CI->load->helper('cookie_helper');
	}
	
	//获取所有用户
	public function get_users() {
		$res = $this->CI->user_model->get_users();
		return $res;
	}
	
	//检查登录参数
	public function check_user($data) {
		$res = array('status' => 'success','error_code'=>'','message' =>'');
        $username = isset($data['username']) ? $data['username'] : "";
        $password = isset($data['password']) ? $data['password'] : "";
        if (empty($username) || empty($password)) {
        	$res['status'] = 'failed';
        	$res['error_code'] = '1';
        	$res['message'] = 'username and password required';
        	return $res;
        }
        return $res;
	}
	
	//后台用户登录
	public function login($username, $password) {
		$res = array('status' => 'success','error_code'=>'','message' =>'');
		if(empty($username) || empty($password))
		{
			$res['status'] = 'failed';
			$res['error_code'] = '5';
			$res['message']="username and password required";
			return $res;
		}
		$user_info = $this->CI->user_model->get_user_by_username($username);
		if(empty($user_info)) {
			$res['status'] = 'failed';
			$res['error_code'] = '4';
			$res['message'] = 'username not exists';
			return $res;
		}
		
		$db_username = $user_info[0]['username'];
		$db_password = $user_info[0]['password'];
		$db_status = $user_info[0]['status'];
		$db_userid = $user_info[0]['id'];
		$db_role_id = $user_info[0]['role_id'];
		
		//是否停用
		if(!isset($db_status) || ($db_status == '0')) {
			$res['status'] = 'failed';
			$res['error_code'] = '3';
			$res['message'] = 'user is locked';
			return $res;
		}
		
		//密码校验
		$md5_pwd = md5_encode($password);
		if($md5_pwd === $db_password) {
			$data = array (
					'last_login' => date ( "Y-m-d H:i:s", $_SERVER ["REQUEST_TIME"] ),
					'last_login_ip' => $this->CI->input->ip_address () 
				);
			$this->CI->user_model->update_user_by_id($db_userid, $data);
			$this->CI->session->set_userdata('username', $db_username);
			$this->CI->session->set_userdata('userid', $db_userid);
			$this->CI->session->set_userdata('roleid', $db_role_id);
			
			$res['userdata'] = array(
					'userid' => $db_userid,
					'name' => $db_username,
					'roleid' => $db_role_id,
					'status' => $db_status,
					
			);
			
		} else {
			$res['status'] = 'failed';
			$res['error_code'] = '2';
			$res['message'] = 'username or password error';
		}
		return $res;
	}
}
 