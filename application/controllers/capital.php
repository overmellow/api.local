<?php
class Capital extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('capital_model');
        $this->load->library('table');
        $this->load->helper('html');
    }
    
    public function index()
    {
        $data['transactions'] = $this->capital_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('capital/index', $data);
        $this->load->view('template/footer', $data);
    }
}
