<?php
class City extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	//--------------------------------------------------------------------

	public function index($ostan_id, $city_select = null)
	{
		$ostan_id = (int) $ostan_id;
		$this->db->select('city, city_id');
		$this->db->where('ostan_id', $ostan_id);
		$query = $this->db->get('city');
		$city = null;
		$select = null;
		if($query->result())
		{
			foreach ($query->result() as $row) {
				if($row->city_id == $city_select)
				{
					$select = 'selected="selected"';
				}
				$city .= '<option ' . $select .' value="' . $row->city_id . '">' . $row->city . '</option>';
      			$select = null;
			}
		}
		echo $city;
		
	}

	//--------------------------------------------------------------------


}