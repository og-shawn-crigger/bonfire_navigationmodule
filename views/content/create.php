
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
        <?php echo form_label('Title', 'title'); ?> <span class="required">*</span>
        <input id="title" type="text" name="title" maxlength="30" value="<?php echo set_value('title', isset($navigation['title']) ? $navigation['title'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('URL', 'url'); ?> <span class="required">*</span>
        <input id="url" type="text" name="url" maxlength="150" value="<?php echo set_value('url', isset($navigation['url']) ? $navigation['url'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Group', 'nav_group_id'); ?> <span class="required">*</span>
		<?php echo form_dropdown("nav_group_id", $groups, isset($navigation['nav_group_id']) ? $navigation['nav_group_id'] : '', array("id" => "nav_group_id"));?>
</div>

<div>
        <?php echo form_label('Position', 'position'); ?> <span class="required">*</span>
        <input id="position" type="text" name="position" maxlength="2" value="<?php echo set_value('position', isset($navigation['position']) ? $navigation['position'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Parent', 'parent_id'); ?> <span class="required">*</span>
		<?php echo form_dropdown("parent_id", $parents, isset($navigation['parent_id']) ? $navigation['parent_id'] : '', array("id" => "parent_id"));?>
</div>

<div>
        <?php echo form_label('Has Kids', 'has_kids'); ?> <span class="required">*</span>
        <input id="has_kids" type="text" name="has_kids" maxlength="1" value="<?php echo set_value('has_kids', isset($navigation['has_kids']) ? $navigation['has_kids'] : '0'); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Navigation" /> or <?php echo anchor(SITE_AREA.'/content/navigation', lang('navigation_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
