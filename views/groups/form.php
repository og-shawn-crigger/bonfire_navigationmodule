<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="admin-box">

    <h3><?php echo lang('navigation_group'); ?></h3>

    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

    <fieldset>
        <legend><?php echo lang('mod_settings_title'); ?></legend>
	
		<div class="control-group <?php echo form_error('title') ? 'error' : '' ?>">
			<label class="control-label" for="title"><?php echo lang('navigation_group_title'); ?></label>
			<div class="controls">
				<input id="title" type="text" name="title" maxlength="30" value="<?php echo set_value('title', isset($navigation->title) ? $navigation->title : ''); ?>"  />
				<?php if (form_error('title')) echo '<span class="help-inline">'. form_error('title') .'</span>'; ?>
			</div>
		</div>
		
		<div class="control-group <?php echo form_error('abbr') ? 'error' : '' ?>">
			<label class="control-label" for="abbr"><?php echo lang('navigation_abbreviation'); ?></label>
			<div class="controls">
				<input id="abbr" type="text" name="abbr" maxlength="20" value="<?php echo set_value('abbr', isset($navigation->abbr) ? $navigation->abbr : ''); ?>"  />
				<?php if (form_error('abbr')) echo '<span class="help-inline">'. form_error('abbr') .'</span>'; ?>
			</div>
		</div>
	
	</fieldset>
	
	<div class="form-actions">
		<input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang('bf_action_save'); ?>" />
	</div>
	
	<?php echo form_close(); ?>
</div>