<?php

class Trader_model extends CI_Model{
    
    public function __construct(){
        $this->load->database();
    }
    
    public function create(&$data){
        return $this->db->insert('trader', $data); 
    }
    
    public function get_all() {
        $query = $this->db->get('trader');
        return $query->result_array();
    } 
}
