<?php
class Fund_model extends CI_Model {
    
    public function __construct(){
        $this->load->database();
    }
        
    public function get($id, $user_id){
	$query = $this->db->get_where('fund', array('id' => $id, 'user_id' => $user_id));
	return $query->row_array();
    }  
    
    public function create(&$data){
        return $this->db->insert('fund', $data); 
    }
    
    public function update($id, $user_id, &$data){
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('fund', $data); 
    }
    
    public function delete($id, $user_id) {
        return $this->db->delete('fund', array('id' => $id, 'user_id' => $user_id)); 
    }
    
    public function get_all() {
        $query = $this->db->get_where('fund');
        return $query->result_array();
    }
}