<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Attestation
{       
    public function has_access_token($token_id = FALSE)
    {
        if(!$token_id)
        {
            return FALSE;
        }
        
        $CI =& get_instance();
        $has_access_token = $CI->token_model->validate_token($token_id);
        
        if(!$has_access_token)
        {
            return FALSE;
        }       
        
        return TRUE;
    }
    
    public function is_logged_in()
    {
        $CI =& get_instance();

        $is_logged_in = $CI->session->userdata('is_logged_in');

        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect('authentication/login');
        }
    }
    
    public function get_user_session_data()
    {
        $CI =& get_instance();

        $user = $CI->session->all_userdata();

        if(isset($user))
        {
            return $user;
        }
    }
}