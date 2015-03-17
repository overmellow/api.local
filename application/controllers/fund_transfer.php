<?php
class Fund_transfer extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('capital_model');
        $this->load->model('fund_model');
        $this->load->model('fund_transfer_model');
        
        $this->output->enable_profiler(TRUE);
    }
    
    public function index()
    {
        $data['funds'] = $this->fund_transfer_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('fund_transfer/index', $data);
        $this->load->view('template/footer', $data);
    }
    
    function create(){        
        $last = $this->fund_transfer_model->get($this->input->post('id'));        
        
        if(empty($last))
        {
            $last['balance'] = 0;
        }
        
        $data = array(
            'reference_id' => $this->input->post('id'),
            'transaction_type' => 'capital',
            'previous_balance' => $last['balance'],
            'transaction_amount' => $this->input->post('amount'),
        );
                        
        $data['balance'] = $last['balance'] + $this->input->post('amount');
        
        $result = $this->fund_transfer_model->create($data);
        
        $capital_last = $this->capital_model->get();
        
        $capital_data = array(
            'reference_id' => $result,
            'transaction_type' => 'fund',
            'previous_balance' => $capital_last['balance'],
            'transaction_amount' => -($this->input->post('amount')),
        );

        $capital_data['balance'] = $capital_last['balance'] + $this->input->post('amount');        
        
        $capital_result = $this->capital_model->create($capital_data);    
    } 
}
