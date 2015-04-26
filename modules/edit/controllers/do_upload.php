<?php
class Do_upload extends Front_Controller
{
    protected $path_img_upload_folder;

    protected $delete_img_url;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }



    protected function get_path($curent_user_id,$year,$month, $current_house_id, $thumbnail = false)
    {

        $path_img_upload_folder = "assets/img/house/";
        if($thumbnail){
            $path = $path_img_upload_folder . "$curent_user_id/$year/$month/$current_house_id/thumbnail";
            $path = $path_img_upload_folder . "$curent_user_id/";
            //create current id folder
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current year folder
            $path .= "$year/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current month folder
            $path .= "$month/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current current_house_id folder
            $path .= "$current_house_id/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current thumbnail folder
            $path .= "thumbnail/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            
            
            return $path;
        }
        else{
            $path = $path_img_upload_folder . "$curent_user_id/";
            //create current id folder
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current year folder
            $path .= "$year/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current month folder
            $path .= "$month/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            //current current_house_id folder
            $path .= "$current_house_id/";
            if (!file_exists($path)) {
                mkdir($path, 0755);
            }
            
            return $path;
        }
    }

    // Function called by the form
    public function upload_img()
    {
    	header('Content-type: application/json');

        //Format the name
        $current_id     = $this->session->userdata('id');
        $year           = date('Y');
        $month          = date('m');
        $house_id       = $this->session->userdata('house_id');
        $name = $_FILES['file']['name'];
        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

        // replace characters other than letters, numbers and . by _
        $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

        //Your upload directory, see CI user guide
        $config['upload_path'] = $this->get_path($current_id, $year, $month, $house_id);

        $config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
        $config['max_size'] = '2000';
        $config['file_name'] = $name;
        
        //Load the upload library
        $this->load->library('upload', $config);

        if ($this->do_upload())
        {
            // Codeigniter Upload class alters name automatically (e.g. periods are escaped with an
            //underscore) - so use the altered name for thumbnail
            $data = $this->upload->data();
            $name = $data['file_name'];

            $url_image = site_url() . $this->get_path($current_id, $year, $month, $house_id) . $name;
            
            $data_iamge = array(
                'house_id'  => $house_id,
                'image_url' => $url_image, 
            );
            
            $this->db->insert('images', $data_iamge);
            //If you want to resize 
            $config['new_image'] = $this->get_path($current_id, $year, $month, $house_id, true);
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->get_path($current_id, $year, $month, $house_id) . $name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 250;
            $config['height'] = 250;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            //Get info 
            $info = new stdClass();

            $info->name = $name;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
            $info->url  = $this->get_path($current_id, $year, $month, $house_id) . $name;
            $info->thumbnail_url = $this->get_path($current_id, $year, $month, $house_id, true) . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->removeLink = $url_image;
            $info->delete_type = 'DELETE';


            //Return JSON data
            if (IS_AJAX)
            {   
                echo json_encode(array($info));
            }
            else
            {   
                $file_data['upload_data'] = $this->upload->data();
                echo json_encode(array($info));
            }
        }
        else
        {
            $error = array('error' => $this->upload->display_errors('',''));
            echo json_encode(array($error));
        }


    }

    //Function for the upload : return true/false
    public function do_upload()
    {
        if (!$this->upload->do_upload('file'))
        {
            return false;
        }
        else
        {
            //$data = array('upload_data' => $this->upload->data());
            return true;
        }
    }


    //Function Delete image
    public function deleteImage()
    {
        //delete by image id
        $file = $this->uri->segment(3);

        $success = unlink($this->getPath_img_upload_folder() . $file);
        $success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);

        $info = new stdClass();
        $info->sucess = $success;
        $info->path = $this->getPath_url_img_upload_folder() . $file;
        $info->file = is_file($this->getPath_img_upload_folder() . $file);
        if (IS_AJAX)
        {
            echo json_encode(array($info));
        }
        else
        {
            var_dump($file);
        }
    }

}