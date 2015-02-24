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
}