<?php
class Transfer_model extends CI_Model {
    
    public function __construct(){
        $this->load->database();
    }
        
    public function get($id, $user_id){
	
        $this->db->order_by("created_at", "desc"); 
        $this->db->limit(1);
        $query= $this->db->get_where('goal_transfer', array('goal_id' => $id, 'user_id' => $user_id));               
	return $query->row_array();
    }  
    
    public function create(&$data){        
        $this->db->insert('goal_transfer', $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $user_id, &$data){
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('goal_transfer', $data); 
    }
    
    public function delete($id, $user_id) {
        return $this->db->delete('goal_transfer', array('id' => $id, 'user_id' => $user_id)); 
    }
    
    public function get_all($user_id) {
        $query = $this->db->get_where('goal_transfer', array('user_id' => $user_id));
        return $query->result_array();
    }
    
    public function get_balance_all($user_id) {
        $query = $this->db->query('select goal_id, sum(transaction_amount) as balance from goal_transfer where user_id = ' . $user_id . ' group by goal_id' );
        return $query->result_array();
    }
}