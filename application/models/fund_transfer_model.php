<?php
class Fund_transfer_model extends CI_Model {
    
    public function __construct(){
        $this->load->database();
    }
        
    public function get($reference_id){
	
        $this->db->order_by("created_at", "desc"); 
        $this->db->limit(1);
        $query= $this->db->get_where('fund_transfer', array('reference_id' => $reference_id));               
	return $query->row_array();
    }  
    
    public function create(&$data){        
        $this->db->insert('fund_transfer', $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $user_id, &$data){
        $this->db->where('id', $id);
        //$this->db->where('user_id', $user_id);
        return $this->db->update('fund_transfer', $data); 
    }
    
    public function delete($id, $user_id) {
        return $this->db->delete('fund_transfer', array('id' => $id, 'user_id' => $user_id)); 
    }
    
    public function get_all($user_id) {
        $query = $this->db->get_where('fund_transfer', array('user_id' => $user_id));
        return $query->result_array();
    }
    
    public function get_balance_all($reference_id) {
        $query = $this->db->query('select reference_id, sum(transaction_amount) as balance from fund_transfer where reference_id = ' . $reference_id . ' group by reference_id' );
        return $query->result_array();
    }
    
    public function get_fund_transfer_id_from_id($fund_transfer_id) {
        $query = $this->db->get_where('fund_transfer', array('id' => $fund_transfer_id));               
	$result = $query->row_array();        
        return $result['reference_id'];
    }
}