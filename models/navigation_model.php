<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Navigation_model extends BF_Model {

	protected $table		= "navigation";
	protected $key			= "nav_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;

	/**
	 * Load a group
	 * 
	 * @access public
	 * @param string $abbrev The group abbrevation
	 * @return mixed
	 */
	public function load_group($nav_group_id)
	{

		$this->db->where(array('nav_group_id' => $nav_group_id, 'parent_id' => "0"));
		$group_links = $this->navigation_model->order_by('position, title')->find_all();

		$has_current_link = false;
			
		// Loop through all links and add a "current_link" property to show if it is active
		if( ! empty($group_links) )
		{
			foreach($group_links as &$link)
			{
				$full_match 	= site_url($this->uri->uri_string()) == $link->url;
				$segment1_match = site_url($this->uri->rsegment(1, '')) == $link->url;
				
				// Either the whole URI matches, or the first segment matches
				if($link->current_link = $full_match || $segment1_match)
				{
					$has_current_link = true;
				}
				
				//build a multidimensional array for submenus
				if($link->has_kids > 0 AND $link->parent_id == 0)
				{
					$link->children = $this->get_children($link->nav_id);
					
					foreach($link->children as $key => $child)
					{
						//what is this world coming to?
						if($child->has_kids > 0)
						{
							$link->children[$key]->children = $this->get_children($child->nav_id);
							
							foreach($link->children[$key]->children as $index => $item)
							{
								if($item->has_kids > 0)
								{
									$link->children[$key]->children[$index]->children = $this->get_children($item->nav_id);
								}
							}
						}
					}
				}
			}
			
		}

		// Assign it 
	    return $group_links;
	}

	/**
	 * Get children
	 *
	 * @access public
	 * @param integer Get links by parent id
	 * @return mixed
	 */
	public function get_children($id)
	{
		$children = $this->db->where('parent_id', $id)
							->order_by('position')
							->order_by('title')
							->get('navigation')
							->result();
							
		return $children;
	}

	/**
	 * Update the current link's parent
	 * 
	 * @access public
	 * @param int $id        The ID of the link item
	 * @param int $parent_id ID of the parent
	 * @return void
	 */
	public function update_parent($id = 0, $parent_id = 0) 
	{
		if($parent_id == 0)
		{
			// if they're trying to clear the parent selection we need to get the parent's id
			$current = $this->db->get_where('navigation', array('nav_id' => $id))->row();

			// check if the parent has more than one kid
			$siblings = $this->get_children($current->parent_id);
			if (count($siblings) == 1)
			{
				//mark that it has no children
				$this->db->update('navigation', array('has_kids' => 0), array('nav_id' => $current->parent_id));
			}
		}
		else
		{
			$this->db->update('navigation', array('has_kids' => 1), array('nav_id' => $parent_id));
		}
		
		return $this->db->update('navigation', array('parent_id' => $parent_id), array('nav_id' => $id));
	}

	/**
	 * Remove the parent id from kids
	 * 
	 * @access public
	 * @param int $id        The ID of the link item
	 * @param int $parent_id ID of the parent
	 * @return void
	 */
	public function un_parent_kids($id) 
	{
		if($id != 0)
		{
			// check if the parent has more than one kid
			$children = $this->get_children($id);
			foreach ($children as $child)
			{
				$this->db->update('navigation', array('parent_id' => 0), array('nav_id' => $child->nav_id));
			}
		}
	}
}
