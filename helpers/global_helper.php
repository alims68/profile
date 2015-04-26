<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function ostan($id = null, $class = null)
{
  if($class == null)
  {
    $class = 'class="select2me form-control"';
  }
  else{
    $class = 'class="' . $class . '"';
  }
  $CI = get_instance();
   
  $CI->db->select('ostan,ostan_id');
  $CI->db->group_by("ostan");
  $query = $CI->db->get('bf_city');

  $select = null;
  $ostan = '<select onchange="select_city(this.value)" name="ostan" runat="server" id="ostan" '. $class .'>';
  if($query->result())
  {
    $i = 0;
    foreach ($query->result() as $row) {
      if($id != null)
      {
          if($row->ostan_id == $id){
            $select = 'selected="selected"';
          }
      }
      if($i == 0)
      {
        $ostan .= '<option value="0">&#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1575;&#1587;&#1578;&#1575;&#1606;</option>';  
      }
      else{
        $ostan .= '<option ' . $select .' value="' . $row->ostan_id . '">' . $row->ostan . '</option>';
      }
      $i++;
      $select = null;
    }
  }
  $ostan .= '</select>';
  echo $ostan;
}

function city_echo($ostan_id, $city_id)
{
  $CI = get_instance();
  $ostan_id = (int) $ostan_id;
  $CI->db->select('city, city_id');
  $CI->db->where('ostan_id', $ostan_id);
  $query = $CI->db->get('city');
  $city = null;
  $select = null;
  if($query->result())
  {
    foreach ($query->result() as $row) {
      if($row->city_id == $city_id){
        $select = 'selected="selected"';
      }
      $city .= '<option ' . $select .' value="' . $row->city_id . '">' . $row->city . '</option>';
      $select = null;
    }
  }
  echo $city;
}


function get_value($user_id, $meta_key)
{
  $CI = get_instance();
  $CI->db->select('meta_value');
  $CI->db->where('user_id', $user_id);
  $CI->db->where('meta_key', $meta_key);
  $query = $CI->db->get('user_meta');
  if($query->result())
  {
    return $query->row()->meta_value;
  }
  else{
    return false;
  }
}

function if_get_value($user_id, $meta_key)
{
  $CI = get_instance();
  $CI->db->select('meta_value');
  $CI->db->where('user_id', $user_id);
  $CI->db->where('meta_key', $meta_key);
  $query = $CI->db->get('user_meta');
  if($query->result())
  {
    return true;
  }
  else{
    return false;
  }
}

function update_value($user_id, $meta_key, $meta_value)
{
  $CI = get_instance();

  if(if_get_value($user_id, $meta_key))
  {
    $CI->db->where('user_id', $user_id);
    $CI->db->where('meta_key', $meta_key);
    if(is_array($meta_value))
    {
      $meta_value = serialize($meta_value);
    }
    $data_update =  array('meta_value' => $meta_value);
    $query = $CI->db->update('user_meta', $data_update);
  }
  else{
    if(is_array($meta_value))
    {
      $meta_value = serialize($meta_value);
    }
    $data_insert =  array(
      'user_id'     => $user_id, 
      'meta_key'    => $meta_key, 
      'meta_value'  => $meta_value, 
    );
    $query = $CI->db->insert('user_meta', $data_insert);
  }
  
}

function count_like_by_post($post_id)
{
  $CI = get_instance();
  $CI->db->where('post_id', $post_id);
  return $CI->db->count_all_results('likes');
}

function post_like_by_user($post_id, $user_id)
{
  $CI = get_instance();
  $CI->db->where('post_id', $post_id);
  $CI->db->where('user_id', $user_id);
  return $CI->db->count_all_results('likes');
}