<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台用户
 * @author qiaoyi
 *
 */
class Admin_user_service {
	
	private $CI;
	
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth/admin_user_model');
		$this->CI->load->helper('qizhuan_helper');
		$this->CI->load->helper('cookie_helper');
	}
	
	//获取所有用户
	public function get_admin_users($data) {
	    //获取总条数
	    $resCount = $this->CI->admin_user_model->get_admin_users(1, 1, true);
	    //获取结果集

        $pageSize = !empty($data['pageSize']) ? $data['pageSize'] : PAGE_SIZE;
        $pageIndex = !empty($data['pageIndex']) ? $data['pageIndex'] * $pageSize : 0 ;
        $res = $this->CI->admin_user_model->get_admin_users($pageIndex, $pageSize);

		return array(
		    'result' => $res,
            'total' => $resCount[0]['count'],
            'pageSize' => $pageSize,
            'pageIndex' => $pageIndex,
        );
	}
	
	//检查登录参数
	public function check_admin_user($data) {
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
		$user_info = $this->CI->admin_user_model->get_admin_user_by_username($username);
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
			$this->CI->admin_user_model->update_admin_user_by_id($db_userid, $data);
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
 