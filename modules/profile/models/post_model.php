<?php defined('BASEPATH') || exit('No direct script access allowed');

class Post_model extends BF_Model
{
    protected $table_name   = 'posts';
    protected $key          = 'post_id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';

    public function get_posts($limit = 15)
    {
    	$user_id = 2;
        $this->db->limit($limit)
        		->where('deleted', 0)
        		->where('user_id', $user_id)
                ->order_by('post_id', 'desc');

        $query = $this->db->get('posts');
        if ($query->num_rows()) {
            return $query->result();
        }

        return false;
    }

    
}
//end User_model
