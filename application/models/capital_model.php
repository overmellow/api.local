<?php
class Capital_model extends CI_Model {
    
    public function __construct(){
        $this->load->database();
    }
        
    public function get(){
        $this->db->order_by("created_at", "desc"); 
        $this->db->limit(1);
        $query= $this->db->get_where('capital');               
	return $query->row_array();
        
	$query = $this->db->get_where('capital');
	return $query->row_array();
    }  
    
    public function create(&$data){
        return $this->db->insert('capital', $data); 
    }
    
    public function update($id, $user_id, &$data){
        $this->db->where('id', $id);
        return $this->db->update('capital', $data); 
    }
    
    public function delete($id, $user_id) {
        return $this->db->delete('capital', array('id' => $id, 'user_id' => $user_id)); 
    }
    
    public function get_all() {
        $this->db->order_by('created_at', 'desc');        
        $query = $this->db->get('capital');
        return $query->result_array();
    }
}