
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($navigation) ) {
	$navigation = (array)$navigation;
}
$id = isset($navigation['nav_group_id']) ? "/".$navigation['nav_group_id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div>
        <?php echo form_label('Title', 'title'); ?> <span class="required">*</span>
        <input id="title" type="text" name="title" maxlength="30" value="<?php echo set_value('title', isset($navigation['title']) ? $navigation['title'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Abbreviation', 'abbr'); ?> <span class="required">*</span>
        <input id="abbr" type="text" name="abbr" maxlength="20" value="<?php echo set_value('abbr', isset($navigation['abbr']) ? $navigation['abbr'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Navigation" /> or <?php echo anchor('admin/content/navigation', lang('navigation_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
