<?php
class Auth_model extends CI_Model{
      
    public function __construct(){
        $this->load->database();
    }
    
    public function validate($email, $password)
    {      
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        
        if($query->num_rows == 1)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function get_user_info($email)
    {      
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row_array();        
    }   
}
