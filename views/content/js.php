$(function() {
	$( ".sortable" ).sortable({
		update: update_order,
		placeholder: "ui-state-highlight"
	}).disableSelection();
});

function update_order(event, ui) {
	order = new Array();
	$('tr', this).each(function(){
		console.log( $(this).find('input[name="checked[]"]').val() );
		order.push( $(this).find('input[name="checked[]"]').val() );
	});
	order = order.join(',');

	$.post('<?php echo site_url(SITE_AREA . '/content/navigation/ajax_update_positions');?>', { order: order }, function() {
		$('tr').removeClass('alt');
		$('tr:even').addClass('alt');
	});
}