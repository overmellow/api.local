<?php
class Authentication extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        //$this->output->enable_profiler(TRUE);
    }
    
    public function login() {
        
        if($this->input->post())
        {
            $query = $this->auth_model->validate($this->input->post('email'), $this->input->post('password'), 'trader');

            if($query)
            {                        
                $user_info = $this->auth_model->get_user_info($this->input->post('email'), 'trader');           

                $data = array(
                    'email' => $user_info['email'],
                    'name' => $user_info['name'],
                    'id' => $user_info['id'],                
                    'is_logged_in' => true
                );

                $this->session->set_userdata($data);
                redirect('/fund/trader');
            }
        }

        $this->load->view('template/header_guest');
        $this->load->view('authentication/login');
        $this->load->view('template/footer');
    }
        
    public function logout(){
        /**
         * destroying the user session
         */
        $this->session->sess_destroy();
        redirect('authentication/login');
    }
}
