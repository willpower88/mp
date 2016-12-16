<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_filter
{
    
    public static function check_auth()
    {
        $CI = & get_instance();
        $CI->load->helper('url');
        $username = $CI->session->userdata('username');
        $userid = $CI->session->userdata('userid');
        $roleid = $CI->session->userdata('roleid');
        
        if(empty($username) || empty($userid) ||empty($roleid))
        {
            redirect('/user/login');
        }
        
        return TRUE;
    }

    public static function api_check_userid() {
        $CI =& get_instance();
        $CI->load->library('session');
        $user_id = $CI->session->userdata('userid');
        if (empty($user_id)) {
            return array(FALSE, '没有登录');
        }
        $CI->load->model('agent_user_info_model');
        $user_info = $CI->agent_user_info_model->get_user_info_by_id($user_id);
        if (empty($user_info)) {
            return array(FALSE, '帐号不存在');
        }
        if (!isset($user_info['status']) || !in_array($user_info['status'], array('1'))) {
            return array(FALSE, '帐号已被停用');
        }
        return array(TRUE, '');
    }

    public static function current_userid() {
        $CI =& get_instance();
        $CI->load->library('session');
        $user_id = $CI->session->userdata('userid');
        if (empty($user_id)) {
            return 0;
        }
        return $user_id;
    }
}
 
/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
