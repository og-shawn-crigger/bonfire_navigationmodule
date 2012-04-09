<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/navigation') ?>"><?php echo "Links"; ?></a>
	</li>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/navigation/create') ?>"><?php echo "Create Link"; ?></a>
	</li>
	<li <?php echo ($this->uri->segment(4) == 'groups' && $this->uri->segment(5) == '') ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/navigation/groups') ?>"><?php echo 'Groups'; ?></a>
	</li>
	<li <?php echo ($this->uri->segment(4) == 'groups' && $this->uri->segment(5) == 'create') ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/navigation/groups/create') ?>"><?php echo 'Create Group'; ?></a>
	</li>
</ul>
