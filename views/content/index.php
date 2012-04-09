<div class="admin-box">
	<h3>Navigation</h3>

	<ul class="nav nav-tabs" >
		<li <?php echo $filter=='' ? 'class="active"' : ''; ?>><a href="<?php echo $current_url; ?>">All</a></li>
		<li <?php echo $filter=='group' ? 'class="active"' : ''; ?> class="dropdown">
			<a href="#" class="drodown-toggle" data-toggle="dropdown">
				By Group <?php echo isset($filter_group) ? ": $filter_group" : ''; ?>
				<b class="caret light-caret"></b>
			</a>
			<ul class="dropdown-menu">
			<?php foreach ($groups as $group) : ?>
				<li>
					<a href="<?php echo "{$current_url}?filter=group&group_id=". $group->nav_group_id ?>">
						<?php echo $group->title; ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</li>
	</ul>

	<?php echo form_open(current_url()) ;?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th class="column-check"><input class="check-all" type="checkbox" /></th>
				<th><?php echo lang('us_article_id'); ?></th>
				<th><?php echo lang('navigation_title_label'); ?></th>
				<th><?php echo lang('navigation_url_label'); ?></th>
				<th><?php echo lang('navigation_group_label'); ?></th>
				<th><?php echo lang('navigation_parent_label'); ?></th>
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
					<input type="checkbox" name="checked[]" value="<?php echo $record->nav_id ?>" />
				</td>
				<td><?php echo $record->nav_id ?></td>
				<td><?php echo anchor(SITE_AREA.'/content/navigation/edit/'. $record->nav_id, $record->title) ?></td>
				<td><?php echo $record->url; ?></td>
				<td><?php
				foreach($groups as $group) {
					if ($group->nav_group_id == $record->nav_group_id) {
						echo $group->title;
					}
				} ?></td>
				<td><?php echo $record->parent_id != 0 && isset($records[$record->parent_id]->title) ? $records[$record->parent_id]->title : ''; ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6">No items were found that match your selection.</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>

	<div class="well">
		<?php echo $total_records.' records found'; ?>
	</div>
	<?php echo form_close(); ?>

	<?php echo $this->pagination->create_links(); ?>

</div>