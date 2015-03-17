<?php
class Fund extends CI_Controller{
    private $user;
    public function __construct() {
        parent::__construct();
        $this->load->model('capital_model');
        $this->load->model('fund_model');

        $this->attestation->is_logged_in();
        $this->user = $this->attestation->get_user_session_data();
        //$this->output->enable_profiler(TRUE);
    }
    
    // to show all funds
    public function index()
    {
        $data['email'] = $this->user['email'];
        $data['funds'] = $this->fund_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('fund/index', $data);
        $this->load->view('template/footer', $data);
    }
    
    // to show all funds for specific trader
    public function trader()
    {
        $data['email'] = $this->user['email'];
        $data['funds'] = $this->fund_model->get_all_for_trader($this->user['id']);
        
        $this->load->view('template/header', $data);
        $this->load->view('fund/trader', $data);
        $this->load->view('template/footer', $data);
    }
    
    // to add fund
    public function create()
    {       
	$this->form_validation->set_rules('name', 'Name', 'required');

	if ($this->form_validation->run() === FALSE)
	{
            $this->load->view('template/header');
            $this->load->view('fund/create');
            $this->load->view('template/footer');
	}
	else
	{
            $data = array(
                'name' => $this->input->post('name'),
            );            
            
            $this->fund_model->create($data);

            $this->load->view('template/header');
            $this->load->view('template/success');
            $this->load->view('template/footer');
	}    
    }
}
