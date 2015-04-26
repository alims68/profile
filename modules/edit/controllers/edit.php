<?php
class Edit extends Front_Controller
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
	public function index()
	{
		
		$user['theme'] = 'front';

		Template::set('title' , "ویرایش پروفایل");
		Template::set_view('profile_complate'); //تغییر ویو ماژول
		Template::set_theme($user['theme']);
		Template::render();

	}

	public function submit()
	{
		$config = array(
           array(
                 'field'   => 'pishvand',
                 'label'   => 'پیشوند',
                 'rules'   => 'trim|xss_clean'
              ),
           array(
                 'field'   => 'pasvand',
                 'label'   => 'پسوند',
                 'rules'   => 'trim|xss_clean'
              ),
           array(
                 'nam'   => 'nam',
                 'label'   => 'نام',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'family',
                 'label'   => 'نام خانوادگی',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'sex',
                 'label'   => 'جنسیت',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'taeahol',
                 'label'   => 'تاهل',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'ostan',
                 'label'   => 'استان',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'city',
                 'label'   => 'شهر',
                 'rules'   => 'required|trim|xss_clean'
              ),
           array(
                 'nam'   => 'maghta',
                 'label'   => 'مقطع',
                 'rules'   => 'required|trim|xss_clean'
              ),
        );
		$this->form_validation->set_rules($config); 


		if ($this->form_validation->run()) 
		{
      $this->db->where('user_id', 2);
      $this->db->like('meta_key', '_view');
      $this->db->delete('user_meta');

			// print_r($this->input->post());
			foreach ($this->input->post() as $key => $value) {
				update_value(2, $key, $value);
			}
			
			$data = array('status' => 'success', 'errors' => "به روز رسانی انجام شد." ); //success
			echo json_encode($data);
		}
		else{
			$data = array('status' => 'error', 'errors' => validation_errors() ); //success
        	echo json_encode($data);
		}
	}



	//--------------------------------------------------------------------


}