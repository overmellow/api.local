<?php require(APPPATH.'/libraries/REST_Controller.php');

class Api_fund extends REST_Controller {
    
    var $data;
    
    public function __construct()
    {               
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        /*
        if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
            die();
        }
         * 
         */
        
        parent::__construct();
        
        $this->load->model('fund_model');        
        $this->load->model('token_model');
        
        $this->load->library('attestation');
        
        $arr = apache_request_headers();
        //$arr['Authorization'] = 87;
        
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
    }
    
    function fund_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }
 
        $fund = $this->fund_model->get( $this->get('id'), $this->data['user_id'] );
         
        if($fund){
            $this->response($fund, 200);
        }
        else{
            $this->response(NULL, 404);
        }
    }
    
    function fund_post(){
        $data = array(
            'name' => $this->post('name'),
            'amount' => $this->post('amount'),
            'allocation' => $this->post('allocation'),
            'user_id' => $this->data['user_id']
        );

        $result = $this->fund_model->update($this->post('id'), $this->data['user_id'], $data);
         
        if($result === FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }
         
    }
    
    function fund_put(){       
        $data = array(
            'name' => $this->put('name'),
            'amount' => $this->put('amount'),
            'allocation' => $this->put('allocation'),
            'user_id' => $this->data['user_id']
        );
        
        $result = $this->fund_model->create($data);
         
        if($result === FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }         
    }
     
    function funds_get(){       
        
        $funds = $this->fund_model->get_all($this->data['user_id']);
        if($funds)
        {
            $this->response($funds, 200);
        }
        else{
            $this->response(NULL, 404);
        }
    }
    
    function fund_delete(){
        $id = $this->get('id');
        $fund = $this->fund_model->delete($id, $this->data['user_id']);
         
        if($fund){
            $this->response($fund, 200);
        } 
        else{
            $this->response(NULL, 404);
        }
    }
    
    function fund_options() {
        $this->response(NULL, 200);        
    }
}
