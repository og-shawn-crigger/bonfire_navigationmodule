<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Navigation_group_model extends BF_Model {

	protected $table		= "navigation_group";
	protected $key			= "nav_group_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;

	public function find_all($sort_field=null)
	{
		$result_array = parent::find_all();
		
		if (null != $sort_field) {
			$output_array = array();

			if (is_array($result_array) AND count($result_array))
			{
				foreach ($result_array as $key => $record)
				{
					$output_array[$record->$sort_field] = $record;
				}
			}
			
			$result_array = $output_array;
		}
		
		return $result_array;
	}

}
