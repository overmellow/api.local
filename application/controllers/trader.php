<?php

class Trader extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('trader_model');
        $this->load->library('table');
        $this->load->helper('html');
    }
    
    public function index()
    {
        $data['traders'] = $this->trader_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('trader/index', $data);
        $this->load->view('template/footer', $data);
    }
    
    function trader_put(){
        $data = array(
            'name' => $this->put('name'),
            'email' => $this->put('email'),
            'password' => $this->put('password')
        );
        
        $result = $this->trader_model->create($data);
        
        if($result === FALSE){
            $this->response(array('status' => 'failed'));
        }         
        else{
            $this->response(array('status' => 'success'));
        }         
    }
    
    
}
