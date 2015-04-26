<?php defined('BASEPATH') || exit('No direct script access allowed');

class Profile_model extends BF_Model
{
    public function get_all_value($slug)
    {
    	//پیدا کردن آی دی کاربر
        $this->db->select('id');
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        if($query->result())
        {
            $user_id = $query->row()->id;
            //پیدا کردن تمام متاها
            $this->db->select('meta_key,meta_value');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('user_meta');
            if($query->result())
            {
            	return $query->result();
            }
            else{
            	return false;
            }
        }
        else{
            return false;
        }
    }

    public function get_id_by_slug($slug)
    {
        $this->db->select('id');
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        if($query->result())
        {
            return $query->row()->id;
        }
    }

}
//end User_model
