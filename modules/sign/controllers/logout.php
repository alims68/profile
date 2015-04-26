<?php
class Logout extends Front_Controller
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
        if (isset($this->current_user->id)) {
            // Login session is valid. Log the Activity.
            log_activity(
                $this->current_user->id,
                lang('us_log_logged_out') . ': ' . $this->input->ip_address(),
                'users'
            );
		}

        // Always clear browser data (don't silently ignore user requests).
		$this->auth->logout();
        Template::redirect('/');
    }

	//--------------------------------------------------------------------

}