<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_service
{
    
    public static function log($st,$ext_data=array())
    {
        log_message('info',self::conv_str($ext_data,$st));
    }

    public static function debug($log_data)
    {
        if(empty($log_data)) 
            return;
        log_message('debug',self::conv_str($log_data));
    }

    public static function info($log_data)
    {
        if(empty($log_data)) 
            return;
        log_message('info',self::conv_str($log_data));
    }
    
    public static function error($log_data)
    {
        if(empty($log_data)) 
            return;
        log_message('error',self::conv_str($log_data));
    }
    
    private static function conv_str($data=array(),$st=NULL)
    {
        $CI = & get_instance();
        $uri = $CI->uri->uri_string();
        if(empty($uri))
            $output = '[/page/login]'."\t";
        else
            $output = '['.$uri.']'."\t";
        if(!empty($_REQUEST))
        {
            $output .= '[';
            $is_first = TRUE;
            foreach($_REQUEST as $key=>$value)
            {
                if($is_first)
                {
                    $output .= $key.'='.$value;
                    $is_first = FALSE;
                }
                else
                    $output .= '|'.$key.'='.$value;
            }
            $output .= ']'."\t";
        }
        //执行时间
        $output .= '[st='.$st.'ms]'."\t";

        if(is_array($data))
        {
            $output .= '[';
            $is_first = TRUE;
            foreach($data as $key=>$value)
            {
                if($is_first)
                {
                    $output .= $key.'='.$value;
                    $is_first = FALSE;
                }
                else
                    $output .= '|'.$key.'='.$value;
            }
            $output .= ']';
        }
        else
            $output .= '['.$data.']';
        return $output;
    }
}
 
/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
