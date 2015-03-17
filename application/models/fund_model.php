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
    
    public function get_all($trader_id)
    {
        $fund_id = get_fund_id_from_user_id($trader_id);
        $query = $this->db->get_where('fund', array('' => $fund_id));
        return $query->result_array();
    }
    
    public function get_all_for_trader($trader_id)
    {
        $query = $this->db->query("select fund.* from trader inner join trader_fund on trader.id = trader_fund.trader_id inner join fund on fund.id = trader_fund.fund_id where trader.id = " . $trader_id);
        return $query->result_array();
    }
    
    public function get_fund_id_from_user_id($trader_id) {
        $query = $this->db->get_where('trader_fund', array('trader_id' => $trader_id));
        $result = $query->result_array();        
        return $result['fund_id'];
    }
}