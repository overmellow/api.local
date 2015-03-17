<?php
class Trade extends CI_Controller{
    private $user;
    public function __construct() {
        parent::__construct();
        $this->load->model('capital_model');
        $this->load->model('fund_model');
        $this->load->model('fund_transfer_model');
        $this->load->model('trade_model');
        
        $this->attestation->is_logged_in();
        $this->user = $this->attestation->get_user_session_data();
        //$this->output->enable_profiler(TRUE);
    }
    
    public function all($fund_id = FALSE)
    {
        $data['email'] = $this->user['email'];
        $data['trades'] = $this->trade_model->get_all_for_fund($fund_id);
        $data['fund_id'] = $fund_id;
        $data['last'] = $this->fund_transfer_model->get($fund_id); 
        //$date['trades'] = $this->trade_model->get_all($this->input->post('fund_id'));
        
        $this->load->view('template/header', $data);
        $this->load->view('trade/all', $data);
        $this->load->view('template/footer', $data);
    }
    
    public function buy($fund_id = FALSE)
    {
        $data['fund_id'] = $fund_id;
        $data['email'] = $this->user['email'];
	$this->form_validation->set_rules('ticket', 'Ticket', 'required');

	if ($this->form_validation->run() === FALSE)
	{           
            $this->load->view('template/header', $data);
            $this->load->view('trade/buy');
            $this->load->view('template/footer');
	}
	else
	{            
            $last = $this->fund_transfer_model->get($this->input->post('fund_id'));        
        
            if(empty($last))
            {
                $last['balance'] = 0;
            }

            $fund_transfer_data = array(
                'reference_id' => $this->input->post('fund_id'),
                'transaction_type' => 'trade',
                'previous_balance' => $last['balance'],
                'transaction_amount' => -($this->input->post('buy_price') * $this->input->post('size')),
            );

            $fund_transfer_data['balance'] = $last['balance'] - ($this->input->post('buy_price') * $this->input->post('size'));

            $result = $this->fund_transfer_model->create($fund_transfer_data);

            $trade_data = array(
                'fund_transfer_id' => $result,
                'ticket' => $this->input->post('ticket'),
                'type' => 'buy',
                'size' => $this->input->post('size'),
                'item' => $this->input->post('item'),
                'buy_price' => $this->input->post('buy_price'),
                'fund_id' => $this->input->post('fund_id'),
            );        

            $trade_result = $this->trade_model->create($trade_data); 

            $this->load->view('template/header', $data);
            $this->load->view('template/success');
            $this->load->view('template/footer');
	}           
    }
    
    public function sell($fund_id = FALSE, $trade_id = FALSE)
    {
        $data['email'] = $this->user['email'];
        $data['fund_id'] = $fund_id;
	$this->form_validation->set_rules('sell_price', 'Sell Price', 'required');

	if ($this->form_validation->run() === FALSE)
	{
            $data['trade'] = $this->trade_model->get($trade_id);
            
            $this->load->view('template/header', $data);
            $this->load->view('trade/sell', $data);
            $this->load->view('template/footer');
	}
	else
	{                                   
            $reference_id = $this->fund_transfer_model->get_fund_transfer_id_from_id($this->input->post('fund_transfer_id'));
            
            $last = $this->fund_transfer_model->get($reference_id);        

            if(empty($last))
            {
                $last['balance'] = 0;
            }

            $fund_transfer_data = array(
                'reference_id' => $reference_id,
                'transaction_type' => 'trade',
                'previous_balance' => $last['balance'],
                'transaction_amount' => ($this->input->post('sell_price') * $this->input->post('size')),
            );

            $fund_transfer_data['balance'] = $last['balance'] + ($this->input->post('sell_price') * $this->input->post('size'));

            $result = $this->fund_transfer_model->create($fund_transfer_data);

            $trade_data = array(
                //'fund_transfer_id' => $result,
                //'ticket' => $this->input->post('ticket'),
                //'type' => 'sell',
                //'size' => $this->input->post('size'),
                //'item' => $this->input->post('item'),
                'sell_price' => $this->input->post('sell_price'),
                'sell_time' => mdate("%Y-%m-%d %h:%i:%s", time()),
                'commision' => $this->input->post('commision'),
            );

            $trade_result = $this->trade_model->update($this->input->post('id'), $trade_data); 

            $this->load->view('template/header', $data);
            $this->load->view('template/success');
            $this->load->view('template/footer');
	}           
    }
}
