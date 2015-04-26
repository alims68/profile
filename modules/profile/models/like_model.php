<?php defined('BASEPATH') || exit('No direct script access allowed');

class like_model extends BF_Model
{
    protected $table_name   = 'likes';
    protected $set_created  = true;
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

    public function insert($data = array())
    {
        $this->db->where('user_id', 2);
        $this->db->where('post_id', $data['post_id']);
        if($this->db->count_all_results($this->table_name))
        {
            $this->db->delete($this->table_name, array('post_id' => $data['post_id'], 'user_id' => 2)); 

            return "dislike";
        }
        else{
            $id = parent::insert($data);
            return "like";
        }
        
    }

    
}
//end User_model
