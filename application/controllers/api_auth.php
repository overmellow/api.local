<?php require(APPPATH.'/libraries/REST_Controller.php');

class Api_auth extends REST_Controller {

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        parent::__construct();
        
        $this->load->model('auth_model');
        $this->load->model('token_model');
    }
    
    function login_post()
    {    
        $query = $this->auth_model->validate($this->post('email'), $this->post('password'));
         
        if($query)
        {                        
            $user_info = $this->auth_model->get_user_info($this->post('email'));
            
            $token_id = rand(10,100);
            
            $token_data = array(
                'user_id' => $user_info['id'],
                'token_id' => $token_id
            );
            
            $this->token_model->create_token($token_data);
            
            $data = array(
                'email' => $this->post('email'),
                'name' => $user_info['name'],
                'id' => $user_info['id'],
                'access_token' => $token_id,
                'is_logged_in' => true
            );
            
            $this->response($data, 200);  
        }         
        else
        {            
            $this->response(NULL, 401);
        }
         
    }
    
    function logout_post()
    {
        $arr = apache_request_headers();
        $this->token_model->destroy_token($arr['Authorization']);
        
        $us = array("Logged out successfully!");
        $this->response($us, 200);
    }
    
    function login_options() {
        $this->response(NULL, 200);        
    }
}
