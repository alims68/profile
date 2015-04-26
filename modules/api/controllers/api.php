<?php
class Api extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	//--------------------------------------------------------------------
	/**
	 * [register description]
	 * @param  string $type register type {email,mobile}
	 * @return bool
	 */
	public function register()
	{
		$this->load->helper('string');
		$this->load->library('users/auth');
		$type = $this->input->post('type');


		$result = null;
		if ( $this->input->post() )
		{
			if($type == "email")
			{
				$email = $this->input->post('email');
				$password = $this->auth->hash_password(random_string('alnum',5));
				$username = explode('@', $email);
				$data_new_user = array(
					'email' 		=>  $email,
					'username' 		=>  $username[0],
					'password_hash' =>  $password['hash'],
					'last_ip'       =>  $this->input->ip_address(),
					'active'        =>  1,
					'created_on'    =>  date("Y-m-d H:m:s"),
				);
				unset($data_new_user['password'], $password);
				
				$this->db->insert('users', $data_new_user);
				$user_id = $this->db->insert_id();
				$data_meta = array(
					'user_id' 		=>  $user_id,
					'meta_key' 		=>  'profile_complate',
					'meta_value' 	=>   1
				);
				$this->db->insert('user_meta', $data_meta);
				$result = 1;
			}
			elseif ($type = "mobile") {
				$username = $data['mobile'];
				$result = 1;
			}

			echo json_encode($result);
		}

		
	}


	public function login()
	{

	}

	public function is_login()
	{

	}


	public function active()
	{

	}


	//--------------------------------------------------------------------


}