<div class="admin-box">
	<h3><?php echo "Navigation"; ?></h3>

	<ul class="nav nav-tabs" >
		<li class="active"><a href="#">All</a></li>
	</ul>

	<?php echo form_open(current_url()) ;?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th class="column-check"><input class="check-all" type="checkbox" /></th>
				<th><?php echo lang('navigation_group_id'); ?></th>
				<th><?php echo lang('navigation_group_title'); ?></th>
				<th><?php echo lang('navigation_abbreviation'); ?></th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
			<tr>
				<td colspan="6">
					<?php echo lang('bf_with_selected') ?>
					<input type="submit" name="submit" class="btn-danger" id="delete-me" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('navigation_delete_confirm'); ?>')">
				</td>
			</tr>
		</tfoot>
		<?php endif; ?>
		<tbody>

		<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<td>
					<input type="checkbox" name="checked[]" value="<?php echo $record->nav_group_id ?>" />
				</td>
				<td><?php echo $record->nav_group_id ?></td>
				<td><?php echo anchor(SITE_AREA.'/content/navigation/groups/edit/'. $record->nav_group_id, $record->title) ?></td>
				<td><?php echo $record->abbr; ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6"></php echo echo lang('navigation_no_records'); ?> <?php echo anchor(SITE_AREA.'/content/navigation/groups/create', lang('navigation_create_new'));?>.</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>

	<?php echo $this->pagination->create_links(); ?>

</div>