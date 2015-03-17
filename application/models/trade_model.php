<?php
class Trade_model extends CI_Model {
    
    public function __construct(){
        $this->load->database();
    }
        
    public function get($id){
        
	//$query = $this->db->get_where('trade', array('id' => $id, 'user_id' => $user_id));
        $query = $this->db->get_where('trade', array('id' => $id));
	return $query->row_array();
    }  
    
    public function create(&$data){
        return $this->db->insert('trade', $data); 
    }
    
    public function update($id, &$data){
        $this->db->where('id', $id);
        //$this->db->where('user_id', $user_id);
        return $this->db->update('trade', $data); 
    }
    
    public function delete($id, $user_id) {
        return $this->db->delete('trade', array('id' => $id, 'user_id' => $user_id)); 
    }
    
    public function get_all() {
        $query = $this->db->get('trade');
        //$query = $this->db->get_where('trade');
        return $query->result_array();
    }
    
    public function get_open_all($fund_id) {
        $query = $this->db->get_where('trade', array('sell_time' => 0));
        return $query->result_array();
    }
    
    public function get_all_for_fund($fund_id){
        $query = $this->db->get_where('trade', array('sell_time' => 0, 'fund_id' => $fund_id));
        return $query->result_array();
    }
}