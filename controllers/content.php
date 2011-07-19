<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content extends Admin_Controller {
               
	function __construct()
	{
 		parent::__construct();

		$this->auth->restrict('Navigation.Content.View');
		$this->load->model('navigation_model');
		$this->load->model('navigation_group_model');
		$this->lang->load('navigation');
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.8.min.js');
		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set_block('sub_nav', 'content/_sub_nav');
	}
	
	
	/** 
	 * function index
	 *
	 * list form data
	 */
	public function index()
	{
		$data = array();
		$data["records"] = $this->navigation_model->order_by('nav_group_id, position')->find_all();
		$data["groups"] = $this->navigation_group_model->find_all('nav_group_id');

		Template::set_view("content/index");
		Template::set("data", $data);
		Template::set("toolbar_title", "Manage Navigation");
		Template::render();
	}
	
	//--------------------------------------------------------------------
	
	
	public function create() 
	{
		$this->auth->restrict('Navigation.Content.Create');

		$nav_items = $this->navigation_model->order_by('nav_group_id, position')->find_all();
		$data['parents'][] = '';
		foreach($nav_items as $key => $record)
		{
			$data['parents'][$record->nav_id] = $record->title;
		}

		$groups = $this->navigation_group_model->find_all('nav_group_id');
		foreach($groups as $group_id => $record)
		{
			$data['groups'][$group_id] = $record->title;
		}
		Template::set("data", $data);

		if ($this->input->post('submit'))
		{
			if ($this->save_navigation())
			{
				Template::set_message(lang("navigation_create_success"), 'success');
				Template::redirect('/admin/content/navigation');
			}
			else 
			{
				Template::set_message(lang("navigation_create_failure") . $this->navigation_model->error, 'error');
			}
		}
	
		Template::set_view('content/create');
		Template::set('toolbar_title', lang("navigation_create_new_button"));
		Template::render();
	}
	//--------------------------------------------------------------------
	
	
	public function edit() 
	{
		$this->auth->restrict('Navigation.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang("navigation_invalid_id"), 'error');
			redirect('/admin/content/navigation');
		}

		$nav_items = $this->navigation_model->order_by('nav_group_id, position')->find_all();
		$data['parents'][] = '';
		foreach($nav_items as $key => $record)
		{
			$data['parents'][$record->nav_id] = $record->title;
		}

		$groups = $this->navigation_group_model->find_all('nav_group_id');
		foreach($groups as $group_id => $record)
		{
			$data['groups'][$group_id] = $record->title;
		}
		Template::set("data", $data);

		if ($this->input->post('submit'))
		{
			if ($this->save_navigation('update', $id))
			{
				Template::set_message(lang("navigation_edit_success"), 'success');
			}
			else 
			{
				Template::set_message(lang("navigation_edit_failure") . $this->navigation_model->error, 'error');
			}
		}
		
		Template::set('navigation', $this->navigation_model->find($id));
	
		Template::set('toolbar_title', lang("navigation_edit_heading"));
		Template::set_view('content/edit');
		Template::set("toolbar_title", "Manage Navigation");
		Template::render();		
	}
	
			
	public function delete() 
	{	
		$this->auth->restrict('Navigation.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->navigation_model->delete($id))
			{
				Template::set_message(lang("navigation_delete_success"), 'success');
			} else
			{
				Template::set_message(lang("navigation_delete_failure") . $this->navigation_model->error, 'error');
			}
		}
		
		redirect('/admin/content/navigation');
	}
		
	public function save_navigation($type='insert', $id=0) 
	{	
			
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean|max_length[30]');			
		$this->form_validation->set_rules('url','URL','required|trim|xss_clean|max_length[150]');			
		$this->form_validation->set_rules('nav_group_id','Group','required|trim|xss_clean|is_numeric|max_length[11]');			
		$this->form_validation->set_rules('position','Position','required|trim|xss_clean|is_numeric|max_length[2]');			
		$this->form_validation->set_rules('parent_id','Parent','required|trim|xss_clean|is_numeric|max_length[11]');			
		$this->form_validation->set_rules('has_kids','Has Kids','required|trim|xss_clean|is_numeric|max_length[1]');
		if ($this->form_validation->run() === false)
		{
			return false;
		}
		
		if ($type == 'insert')
		{
			$id = $this->navigation_model->insert($_POST);
			
			if (is_numeric($id))
			{
				$return = true;
			} else
			{
				$return = false;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->navigation_model->update($id, $_POST);
		}
		
		return $return;
	}
	
	public function ajax_update_positions()
	{
		// Create an array containing the IDs
		$ids = explode(',', $this->input->post('order'));

		// Counter variable
		$pos = 1;

		foreach($ids as $id)
		{
			// Update the position
			$data['position'] = $pos;
			$this->navigation_model->update($id, $data);
			++$pos;
		}

	}

}
