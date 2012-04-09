<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_navigation extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`nav_id` int(11) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`title` VARCHAR(30) NOT NULL');
		$this->dbforge->add_field('`url` VARCHAR(150) NOT NULL');
		$this->dbforge->add_field('`nav_group_id` INT(11) NOT NULL');
		$this->dbforge->add_field('`position` INT(2) NOT NULL');
		$this->dbforge->add_field('`parent_id` INT(11) NOT NULL');
		$this->dbforge->add_field('`has_kids` INT(1) NOT NULL');
		$this->dbforge->add_key('nav_id', true);
		$this->dbforge->create_table('navigation');

		$this->dbforge->add_field('`nav_group_id` int(11) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`title` VARCHAR(30) NOT NULL');
		$this->dbforge->add_field('`abbr` VARCHAR(20) NOT NULL');
		$this->dbforge->add_key('nav_group_id', true);
		$this->dbforge->create_table('navigation_group');

		// permissions
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Content.View','Allows User to View Navigation Items','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Content.Create','Allows User to Create Navigation Items','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Content.Edit','Allows User to Edit Navigation Items','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Content.Delete','Allows User to Delete Navigation Items','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Settings.View','Allows User to View navigation Settings','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Navigation.Settings.Manage','Allows User to Edit navigation Settings','active');");
		$this->db->query("INSERT INTO {$prefix}role_permissions VALUES (1,".$this->db->insert_id().");");
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('navigation');
		$this->dbforge->drop_table('navigation_group');
		
        // permissions
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Content.View';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Content.View';");
		
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Content.Create';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Content.Create';");
		
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Content.Edit';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Content.Edit';");
		
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Content.Delete';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Content.Delete';");
		
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Settings.View';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Settings.View';");
		
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Navigation.Settings.Manage';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Navigation.Settings.Manage';");
	}
}

//--------------------------------------------------------------------