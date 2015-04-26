<?php
class Forgot extends Front_Controller
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


		$data = array(
		    'title' => $this->lang->line('forgot')
		);
		Template::set($data);
		Template::render();
	}

	//--------------------------------------------------------------------

}