<?php
class Token_model extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function create_token(&$data)
    {             
        return $this->db->insert('token', $data); 
    }
            
    public function validate_token($token_id)
    {      
        $this->db->where('token_id', $token_id);
        $query = $this->db->get('token');
        
        if($query->num_rows == 1)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function get_userid_from_token($token_id)
    {
        $this->db->select('user_id');
        $this->db->where('token_id', $token_id);
        $query = $this->db->get('token');       
        $result = $query->row_array();
        
        return $result['user_id'];
    }
    
    public function destroy_token($token_id)
    {        
        return $this->db->delete('token', array('token_id' => $token_id));  
    }
    
}
