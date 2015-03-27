<?php
class Api extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->lang->load('admin', 'persian');
	}

	//--------------------------------------------------------------------
	
	/**
	 * [register description]
	 * @param  string $type register type {email,mobile}
	 * @return bool
	 */
	public function register()
	{
		$type = $this->input->post('type');
		$this->load->helper('string');
		$result = null;
		if (isset($_POST) )
		{
			if($type == "email")
			{
				$password = $this->auth->hash_password(random_string('alnum',5));
				$username = explode('@', $data['email']);
				$data_new_user = array(
					'email' 		=>	$data['email'],
					'username' 		=>	$username[0],
					'password' 		=>	$password,
					'last_ip'       =>	$this->input->ip_address(),
					'active'        =>	1,
					'created_on'    =>	date("Y-m-d H:m:s"),
				);
				if( $this->db->insert('users', $data_new_user) ){
					$data_meta = array(
						'user_id' 			=>  $this->db->insert_id(),
						'meta_key' 			=>  "profile_complate",
						'meta_value' 		=>  0,
					);
					if( $this->db->insert('user_meta', $data_meta) ){
						// send Password to Email
			        	$result = array(
			        		'id' => 1,
			        		'message' => $this->lang->line('register_complate'), 
	        			); // Register User whith Email Completed
	        		}
	        		$result = array('id' => 0,'message' => $this->lang->line('register_error') );
				}
				$result = array('id' => 0,'message' => $this->lang->line('register_error') );
			}
			elseif ($type = "mobile") {
				$password = $this->auth->hash_password(random_string('alnum',5));
				$username = $this->input->post('mobile');
				$data_new_user = array(
					'email' 		=>	$username.$this->lang->line('email_suffix'),
					'username' 		=>	$username,
					'password' 		=>	$password,
					'last_ip'       =>	$this->input->ip_address(),
					'active'        =>	1,
					'created_on'    =>	date("Y-m-d H:m:s"),
				);			
				if( $this->db->insert('users', $data_new_user) ){
					$data_meta = array(
						'user_id' 			=>  $this->db->insert_id(),
						'meta_key' 			=>  "profile_complate",
						'meta_value' 		=>  0,
					);
					if( $this->db->insert('user_meta', $data_meta) ){
						send_sms($username, $this->lang->line('username').": " . $username . "\n" . $this->lang->line('password').": " . $password );
			        	$result = array(
			        		'id' => 2,
			        		'message' => $this->lang->line('register_complate'), 
	        			); // Register User whith Email Completed
					}
					$result = array('id' => 0,'message' => $this->lang->line('register_error') );
				}
				$result = array('id' => 0,'message' => $this->lang->line('register_error') );
			}
		}
		echo json_encode($result);
	}


	public function login()
	{
		$config = array(
           array(
                 'field'   => 'username',
                 'label'   => $this->lang->line('username'),
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'field'   => 'password',
                 'label'   => $this->lang->line('password'),
                 'rules'   => 'required|trim|xss_clean'
              )
        );
		$this->load->model('user_model');
		
		$data = array(
		    'title' => $this->lang->line('login_title')
		);
		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run())
        {
        	// Try to login.
	        if (true === $this->auth->login(
	                $this->input->post('username'),
	                $this->input->post('password'),
	                $this->input->post('remember') == '1',
	                "PASSWORD_BCRYPT"
	            )
	        ) 
	        {
	            log_activity(
	                $this->auth->user_id(),
	                lang('us_log_logged') . ': ' . $this->input->ip_address(),
	                'users'
	            );
				$result = array('id' => 1,'message' => $this->lang->line('login_complate') );
        	}
        }

	}

	public function is_login()
	{

	}

	public function active()
	{

	}


	//--------------------------------------------------------------------


}