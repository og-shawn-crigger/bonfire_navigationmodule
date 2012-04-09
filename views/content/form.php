<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="admin-box">

    <h3><?php echo lang('navigation_heading'); ?></h3>

    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

    <fieldset>

		<div class="control-group <?php echo form_error('title') ? 'error' : '' ?>">
			<label class="control-label"><?php echo lang('navigation_title_label') ?></label>
			<div class="controls">
				<input id="title" type="text" name="title" maxlength="30" value="<?php echo set_value('title', isset($navigation->title) ? $navigation->title : ''); ?>"  />
				<span class="help-inline"><?php if (form_error('title')) echo form_error('title'); else echo lang('navigation_title_info'); ?></span>
			</div>
		</div>

		<div class="control-group <?php echo form_error('url') ? 'error' : '' ?>">
			<label class="control-label"><?php echo lang('navigation_url_label') ?></label>
			<div class="controls">
				<input id="url" type="text" name="url" maxlength="150" value="<?php echo set_value('url', isset($navigation->url) ? $navigation->url : ''); ?>"  />
				<span class="help-inline"><?php if (form_error('url')) echo form_error('url'); else echo lang('navigation_url_info'); ?></span>
			</div>
		</div>


<?php
	    $selected = isset($navigation->nav_group_id) ? $navigation->nav_group_id : '';

	    echo form_dropdown( array('name' => 'nav_group_id', 'id' => 'nav_group_id'), $groups, $selected, lang('navigation_group_label'), '', iif (form_error('nav_group_id') , form_error('nav_group_id'), lang('navigation_group_label') ) );
/*
		<div class="control-group <?php echo form_error('nav_group_id') ? 'error' : '' ?>">
			<label class="control-label"><?php echo lang('navigation_group_label') ?></label>
			<div class="controls">
				<?php echo form_dropdown("nav_group_id", $groups, isset($navigation->nav_group_id) ? $navigation->nav_group_id : '', array("id" => "nav_group_id"));?>
				<span class="help-inline"><?php if (form_error('nav_group_id')) echo form_error('nav_group_id'); else echo lang('navigation_group_label'); ?></span>
			</div>
		</div>
*/

	    $selected = isset($navigation->parent_id) ? $navigation->parent_id : '';

		echo form_dropdown( array('name' => 'parent_id', 'id' => 'parent_id'), $parents, $selected, lang('navigation_parent_label'), '', iif (form_error('parent_id') , form_error('parent_id'), lang('navigation_parent_info') ) );
/*
		<div class="control-group <?php echo form_error('parent_id') ? 'error' : '' ?>">
			<label class="control-label"><?php echo lang('navigation_parent_label') ?></label>
			<div class="controls">
				<?php echo form_dropdown("parent_id", $parents, isset($navigation->parent_id) ? $navigation->parent_id : '', array("id" => "parent_id"));?>
				<span class="help-inline"><?php if (form_error('parent_id')) echo form_error('parent_id'); else echo lang('navigation_parent_info'); ?></span>
			</div>
		</div>
*/
	    ?>

	</fieldset>
	
	<div class="form-actions">
		<input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang('bf_action_save'); ?>" />
	</div>
	
	<?php echo form_close(); ?>
</div>