<?php
class Verify extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('sign', 'persian');
		$this->lang->load('admin', 'persian');
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
                 'field'   => 'act_code',
                 'label'   => '<?php echo $this->lang->line("act_code"); ?>',
                 'rules'   => 'required|trim|xss_clean'
              )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run())
        {
        	$this->db->where('key', $this->input->post('act_code'));
        	$this->db->where('number', $this->session->userdata('number'));
        	$query = $this->db->get('numbers');
        	if($query->result())
        	{
        		$email = $this->session->userdata('number') . $this->lang->line('email_suffix');

        		$password_rand = rand(1000,9999);
        		// $password = "100";
				$password_hash = $this->auth->hash_password($password_rand);
				$hash = $password_hash['hash'];
        		$data_new_user = array(
		        	'role_id' 			=> 4,
		        	'email' 			=> $email,
		        	'username' 			=> $this->session->userdata('number'),
		        	'last_ip' 			=> $this->input->ip_address(),
		        	'password_hash' 	=> $hash,
		        	'active' 			=> 1,
		        	'created_on' 		=> date("Y-m-d H:m:s")
		        );
		        

		        $this->db->insert('users', $data_new_user);

		        $data_update_number = array('status' => 1 );
		        $this->db->where('number', $this->session->userdata('number'));
		        $this->db->update('numbers', $data_update_number);

		        send_sms($this->session->userdata('number'), "نام کاربری : " . $this->session->userdata('number') . "\n" . "کلمه عبور : " . $password_rand . "\n" . " ");
		        Template::set_message($this->lang->line('register_complate'), 'success');
		        Template::redirect('sign/sign_in');
        	}
        }
		$data = array(
		    'title' => $this->lang->line('verify')
		);
		Template::set($data);
		Template::set_view();
		Template::render();
	}

	//--------------------------------------------------------------------

}