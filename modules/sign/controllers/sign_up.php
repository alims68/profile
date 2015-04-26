<?php
class Sign_up extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('admin', 'persian');
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
                 'field'   => 'username',
                 'label'   => $this->lang->line("username"),
                 'rules'   => 'required|trim|xss_clean|is_unique[users.username]'
              )
        );
		$this->load->library('session');
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run())
        {
            $data = array(
                'number' 		=> $this->input->post('username'),
                'key' 			=> rand(1000,9999),
                'count' 		=> 1,
                'created_on'	=> date("Y-m-d H:m:s")
            );
            $number_session = array(
               'number'  => $data['number']
           );
            // echo $data['key'];
			$this->session->set_userdata($number_session);

			// Check Number fo Not Duplicated
			$this->db->where('number', $data['number']);
			$number = $this->db->count_all_results('numbers');

            // IF New User
            if($number == 0)
            {
            	if ($this->db->insert('numbers', $data))
	            {
	                Template::set_message($this->lang->line('register_success'), 'success');
	                send_sms($data['number'], $data['key']);
	                Template::redirect('sign/verify');
	            }
	            else{
	            	Template::set_message($this->lang->line('register_duplicate'), 'danger');
	            }
            }
            else{
				// $this->db->where('number', $data['number']);
				// $this->db->select();
				// $query = $this->db->get('numbers');
				// if($query->result())
				// {
				// 	$count = $query->row()->count;
				// 	$this->db->where('number', $data['number']);
			 //    	$this->db->update('numbers', $object);
				// }
            	Template::set_message($this->lang->line('register_duplicate'), 'danger');
            }
            
        }

		$data = array(
		    'title' => $this->lang->line('signup')
		);
		Template::set($data);
		Template::set_view();
		Template::render();
	}

	//--------------------------------------------------------------------

}