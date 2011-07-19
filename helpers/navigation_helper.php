<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Sean Downey

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

/*
	File: Navigation Helper
	
	Provides various helper functions when working with displaying the page navigation.
*/


/*
	Function: show_navigation()
	
	Returns the navigation html for a given navigation group
	
	Parameters:
		$abbrev			- Abbreviated name for the navigation group.
		$show_children	- Whether to show the child menu items or not.
		$attributes		- Array of attributes - used for id and class at the moment.
		
	Return:
		A string with the full html for the navigation items. 
*/
if (!function_exists('show_navigation'))
{

	function show_navigation($abbrev, $show_children = TRUE, $attributes=array())
	{
		$ci =& get_instance();
		
		$query = $ci->db->select('nav_group_id')->where('abbr',$abbrev)->get('navigation_group');
		
		if (!$query || $query->num_rows() == 0)
		{
			return;
		}
		
		$group_details = $query->result();
		
		$ci->load->model('navigation/navigation_model');
		
		$group_links = $ci->navigation_model->load_group($group_details[0]->nav_group_id);
		
		list($output, $cur) = show_level($group_links, TRUE, $show_children, $attributes);
		
		return $output;

	}
	
/*
	Function: show_level()
	
	Returns the navigation html for a given navigation level and is used recursively.
	
	Parameters:
		$links			- Array of links to display.
		$top			- Whether this is the top level or not.
		$show_children	- Whether to show the child menu items or not.
		$attributes		- Array of attributes - used for id and class at the moment.
		
	Return:
		A string with the full html for the navigation items. 
*/
	function show_level($links, $top=FALSE, $show_children = TRUE, $attributes=array())
	{
		$has_current = FALSE;
		$output = '<ul';
		if ($top)
		{
			$output .= empty($attributes['id']) ? '' : ' id="'.$attributes['id'].'"';
			$output .= empty($attributes['class']) ? '' : ' class="'.$attributes['class'].'"';
		}
		$output .= '>';
		
		foreach ($links as $link)
		{
			$child_html = '';
			$child_current = FALSE;
			$attributes = array();

			if ($show_children && !empty($link->children) AND is_array($link->children) AND count($link->children))
			{
				list($child_html, $child_current) = show_level($link->children, FALSE);
				
			}

			if ("/".trim(uri_string(), '/') == $link->url || $child_current)
			{
				$attributes['class'] = 'current';
				$has_current = TRUE;
			}

			$output .= "<li";
			$output .= !empty($attributes['class']) ? ' class="'.$attributes['class'].'"' : '';
			$output .= ">".anchor($link->url, $link->title, $attributes);
			$output .= $child_html;
			$output .= "</li>" . PHP_EOL;
		}
		$output .= "</ul>" . PHP_EOL;
		
		return array($output, $has_current);
	}
}