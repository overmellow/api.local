<?php

class User_model extends CI_Model{
    
    public function __construct(){
        $this->load->database();
    }
    
    public function create(&$data){
        return $this->db->insert('user', $data); 
    }
}
