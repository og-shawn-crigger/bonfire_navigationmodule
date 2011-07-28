
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($navigation) ) {
	$navigation = (array)$navigation;
}
$id = isset($navigation['nav_id']) ? "/".$navigation['nav_id'] : '';
?>
	<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
	<div>
			<?php echo form_label(lang('navigation_title_label'), 'title'); ?> <span class="required">*</span>
			<input id="title" type="text" name="title" maxlength="30" value="<?php echo set_value('title', isset($navigation['title']) ? $navigation['title'] : ''); ?>"  />
			<p class="small indent"><?php echo lang('navigation_title_info'); ?></p>
	</div>

	<div>
			<?php echo form_label(lang('navigation_url_label'), 'url'); ?> <span class="required">*</span>
			<input id="url" type="text" name="url" maxlength="150" value="<?php echo set_value('url', isset($navigation['url']) ? $navigation['url'] : ''); ?>"  />
			<p class="small indent"><?php echo lang('navigation_url_info'); ?></p>
	</div>

	<div>
			<?php echo form_label(lang('navigation_group_label'), 'nav_group_id'); ?> <span class="required">*</span>
			<?php echo form_dropdown("nav_group_id", $groups, isset($navigation['nav_group_id']) ? $navigation['nav_group_id'] : '', array("id" => "nav_group_id"));?>
			<p class="small indent"><?php echo lang('navigation_group_info'); ?></p>
	</div>

	<div>
			<?php echo form_label(lang('navigation_parent_label'), 'parent_id'); ?> <span class="required">*</span>
			<?php echo form_dropdown("parent_id", $parents, isset($navigation['parent_id']) ? $navigation['parent_id'] : '', array("id" => "parent_id"));?>
			<p class="small indent"><?php echo lang('navigation_parent_info'); ?></p>
	</div>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit Navigation" /> or <?php echo anchor(SITE_AREA.'/content/navigation', lang('navigation_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<?php if (isset($navigation) && has_permission('Navigation.Content.Delete')) : ?>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA.'/content/navigation/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('navigation_delete_confirm'); ?>')"><?php echo lang('navigation_delete_record'); ?></a>
		
		<h3><?php echo lang('navigation_delete_record'); ?></h3>
		
		<p><?php echo lang('navigation_edit_text'); ?></p>
	</div>
	<?php endif; ?>
