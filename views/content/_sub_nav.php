<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA.'/content/navigation') ?>" <?php echo $this->uri->segment(4) == '' ? 'class="current"' : '' ?> >Maintenance</a>
	<a href="<?php echo site_url(SITE_AREA.'/content/navigation/groups') ?>" <?php echo $this->uri->segment(4) == 'groups' ? 'class="current"' : '' ?> >Groups</a>
</div>
