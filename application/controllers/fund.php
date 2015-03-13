<?php
class Fund extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('capital_model');
        $this->load->model('fund_model');
        $this->load->library('table');
        $this->load->helper('html');
    }
    
    public function index()
    {
        $data['funds'] = $this->fund_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('fund/index', $data);
        $this->load->view('template/footer', $data);
    }
}
