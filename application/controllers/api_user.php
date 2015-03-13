<?php require(APPPATH.'/libraries/REST_Controller.php');

class Api_user extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        //$this->output->set_header('Access-Control-Allow-Origin: *');    
    }
    
    function user_put(){
        $data = array(
            'name' => $this->put('name'),
            'email' => $this->put('email'),
            'password' => $this->put('password')
        );
        
        $result = $this->user_model->create($data);
        //$this->output->set_header("Access-Control-Allow-Origin: *");
        
        //header('Content-type: application/json');
        //header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        
        if($result === FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }         
    }
}
