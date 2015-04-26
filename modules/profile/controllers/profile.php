<?php
class Profile extends Front_Controller
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
	public function index($slug = null)
	{
    if($slug == null)
    {
      $user['theme'] = 'front';
      Template::set('title' , "پروفایل");
      Template::set_view('home'); //تغییر ویو ماژول
      Template::set_theme($user['theme']);
      Template::render();
    }
		else{
      $user['theme'] = 'profile1';
      $this->load->model('profile_model');
      
      $data = $this->profile_model->get_all_value($slug);
      if(is_array($data))
      {
        foreach ($data as $row) 
        {
          Template::set($row->meta_key , $row->meta_value);
        }
        Template::set('user_id' , $this->profile_model->get_id_by_slug($slug));
        Template::set('title' , "پروفایل");
        Template::set_view('home'); //تغییر ویو ماژول
        Template::set_theme($user['theme']);
        Template::render();
      }
      else{
        show_404();
      }
      
    }

	}

  public function post()
  {
    $this->load->model('post_model');
    $config = array(
         array(
               'field'   => 'text',
               'label'   => 'متن',
               'rules'   => 'trim|xss_clean|required'
            )
      );
    $this->form_validation->set_rules($config); 


    if ($this->form_validation->run()) 
    {
      $data = array(
          'text'    => $this->input->post('text'),
          'user_id' => 2
      );
      if ($this->post_model->insert($data))
      {
        $data = array('status' => 'success', 'errors' => "پست ارسال شد." ); //success
        echo json_encode($data);
      }
      
    }
    else{
      $data = array('status' => 'error', 'errors' => validation_errors() ); //success
          echo json_encode($data);
    }
  }

  public function get_post()
  {
    $this->load->helper('pdate');
    $user['theme'] = 'profile1';
    $user_id = 2;
    $this->load->model('post_model');
    $posts = $this->post_model->get_posts();
    if($posts)
    {
      Template::set('posts' , $posts);
      Template::set_theme($user['theme']);
      Template::render('posts_ajax');
    }
  }

  public function like($post_id)
  {
    $this->load->model('like_model');
    $data = array(
          'user_id' => 2,
          'post_id' => $post_id
      );
    
    if($this->like_model->insert($data) == "like")
    {
      $data = array('status' => 'like' ); //like
      echo json_encode($data);
    }
    else{
      $data = array('status' => 'dislike' ); //like
      echo json_encode($data);
    }
  
  }

  public function like_count($post_id)
  {    
    $count_like_by_post = count_like_by_post($post_id);
    if($count_like_by_post)
    {
      echo '<span>' . count_like_by_post($post_id) . '</span><i class="fa fa-heart fa-2x"></i>';
    }
    else{
      echo '<span>' . count_like_by_post($post_id) . '</span><i class="fa fa-heart-o fa-2x"></i>';
    }
  }

  public function follow($user_id)
  {
    $this->load->model('follow_model');
    $data = array(
      'user_id'     => $user_id, 
      'follower_id' => $this->current_user->id, 
    );
    $this->follow_model->insert($data);

    $data_json = array('status' => 1);
    echo json_encode($data);
  }



	//--------------------------------------------------------------------


}