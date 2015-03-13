<?php require(APPPATH.'/libraries/REST_Controller.php');

class Api_goal extends REST_Controller {
    
    var $data;
    
    public function __construct()
    {                      
        parent::__construct();
        
        $this->load->model('goal_model');
        $this->load->model('transfer_model');
        $this->load->model('token_model');
        
        $this->load->library('attestation');
        
        $arr = apache_request_headers();

        if(!isset($arr['Authorization']))
        {
            $this->response(array('status' => 'Unauthorized Access!'), 401);
        }
        
        $auth = $this->attestation->has_access_token($arr['Authorization']);        
        
        if(!$auth)
        {
            $this->response(array('status' => 'Unauthorized Access!'), 401);
        }
        
        $this->data['user_id'] = $this->token_model->get_userid_from_token($arr['Authorization']);
        
        $this->output->enable_profiler(TRUE);
    }
    
    function goal_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 
        $fund = $this->goal_model->get( $this->get('id'), $this->data['user_id'] );
         
        if($fund)
        {
            $this->response($fund, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function goal_post()
    {
        $data = array(
            'name' => $this->post('name'),
            'balance' => $this->post('balance'),
            'target' => $this->post('target'),
            'allocation' => $this->post('allocation'),
            'user_id' => $this->data['user_id']
        );

        $result = $this->goal_model->update($this->post('id'), $this->data['user_id'], $data);
         
        if($result === FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }         
    }
    
    function goal_put()
    {       
        $data = array(
            'name' => $this->put('name'),
            'target' => $this->post('target'),
            'allocation' => $this->put('allocation'),
            'user_id' => $this->data['user_id']
        );
        
        $result = $this->goal_model->create($data);
         
        if($result == FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }         
    }     
    
    function goal_delete()
    {
        $id = $this->get('id');
        $fund = $this->goal_model->delete($id, $this->data['user_id']);
         
        if($fund){
            $this->response($fund, 200);
        } 
        else{
            $this->response(NULL, 404);
        }
    }
    
    function goals_get()
    {               
        $funds = $this->goal_model->get_all($this->data['user_id']);                       
        $funds_balances = $this->transfer_model->get_balance_all($this->data['user_id']);
        
        $i = 0;
        $j = 0;
        $result = array();
        
        foreach ($funds as $fund)
        {
            while ($fund['id'] != $funds_balances[$i]['goal_id'])
            {
                ++$i;                
            }
            
            $result[$j] = $fund;
            $result[$j]['balance'] = $funds_balances[$i]['balance'];
            ++$j;            
        }
        
        if($result){
            $this->response($result, 200);
        }else{
            $this->response(NULL, 404);
        }        
    }
    
    function goal_options()
    {
        $this->response(NULL, 200);        
    }   
}
