
<div class="view split-view">
	
	<!-- Role List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['nav_group_id']; ?>">
						<p>
							<b><?php echo $record['title']; ?></b><br/>
							<span class="small">Abbr: <?php echo $record['abbr']; ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('navigation_no_records'); ?> <?php echo anchor('admin/content/navigation/groups/create', lang('navigation_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Role Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url('/admin/content/navigation/groups/create')?>"><?php echo lang('navigation_create_new_button');?></a>

				<h3><?php echo lang('navigation_create_new');?></h3>

				<p><?php echo lang('navigation_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>Navigation</h2>
	<table>
		<thead>
		<th>Title</th>
		<th>Abbreviation</th><th><?php echo lang('navigation_actions'); ?></th>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
<?php $record = (array)$record;?>
			<tr>
<?php
	foreach($record as $field => $value)
	{
		if($field != "nav_group_id") {
?>
				<td><?php echo $value;?></td>

<?php
		}
	}
?>
				<td><?php echo anchor('admin/content/navigation/groups/edit/'. $record['nav_group_id'], 'Edit', 'class="ajaxify"') ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
