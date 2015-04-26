<?php
class Sign_in extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('sign', 'persian');
		$this->load->library('users/auth');
		$this->load->library('form_validation');
		// If the user is already logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }
	}

	//--------------------------------------------------------------------

	public function index()
	{
		Template::set_theme('front');
		$config = array(
           array(
                 'field'   => 'login_mobile',
                 'label'   => $this->lang->line("phone_number"),
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'field'   => 'login_pass',
                 'label'   => $this->lang->line("password"),
                 'rules'   => 'required|trim|xss_clean'
              )
        );
		$this->load->model('user_model');
		
		$data = array(
		    'title' => $this->lang->line('signin')
		);
		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run())
        {
        	// Try to login.
	        if (true === $this->auth->login(
	                $this->input->post('login_mobile'),
	                $this->input->post('login_pass'),
	                $this->input->post('remember-password') == '1',
	                "PASSWORD_BCRYPT"
	            )
	        )
	        {
	            log_activity(
	                $this->auth->user_id(),
	                lang('us_log_logged') . ': ' . $this->input->ip_address(),
	                'users'
	            );
	            Template::redirect('/edit');
        	}
        }

		Template::set('title', $this->lang->line('signin'));
		Template::set_view();
		Template::render();
	}

	//--------------------------------------------------------------------


}