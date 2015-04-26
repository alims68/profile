<?php
class Number_model extends MY_Model
{

	protected $table_name   = 'numbers';
	protected $key          = 'number_id';
	protected $set_created  = true;
	protected $set_modified = true;
	protected $soft_deletes = true;
	protected $date_format  = 'datetime';

	//---------------------------------------------------------------
	protected $validation_rules = array(
        array(
            'field' => 'mobile',
            'label' => 'mobile',
            'rules' => 'trim|strip_tags|xss_clean|number'
        )
    );
	
	protected $insert_validation_rules = array(
        'mobile' => 'integer'
    );
}