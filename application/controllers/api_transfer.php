<?php require(APPPATH.'/libraries/REST_Controller.php');

class Api_transfer extends REST_Controller {
    
    var $data;
    
    public function __construct()
    {                      
        parent::__construct();
        
        $this->load->model('goal_model');
        $this->load->model('transfer_model');
        $this->load->model('capital_model');
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
    
    function transfer_put(){        
        $last = $this->transfer_model->get($this->put('id'), $this->data['user_id']);        
        
        if(empty($last))
        {
            $last['balance'] = 0;
        }
        
        $data = array(
            'goal_id' => $this->put('id'),
            'kind' => $this->put('kind'),
            'previous_balance' => $last['balance'],
            'transaction_amount' => $this->put('amount'),
            'user_id' => $this->data['user_id']
        );
                        
        $data['balance'] = $last['balance'] + $this->put('amount');
        
        $result = $this->transfer_model->create($data);
        
        $capital_last = $this->capital_model->get();
        
        $capital_data = array(
            'reference_id' => $result,
            'transaction_type' => 'goal',
            'previous_balance' => $capital_last['balance'],
            'transaction_amount' => $this->put('amount'),
        );
        
        $capital_data['balance'] = $capital_last['balance'] + $this->put('amount');
        
        $capital_result = $this->capital_model->create($capital_data);
      
        if($result == FALSE && $capital_result == FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }        
    }     
}
