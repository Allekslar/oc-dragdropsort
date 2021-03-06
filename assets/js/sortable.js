/**
 * initializeSorting()
 *
 * This sets up our list to interact with html5sortable. It is called
 * on page load, and after the list is refreshed.
 */
function initializeSorting() {

	// Disable our toolbar buttons
	const elems = document.querySelector("#updatePosition");
	[].forEach.call(elems, function() {		
		  this.disabled = true;
	  });

	// Add a sortable class to our table so our css can easily distinguish
	// sortable / non-sortable lists.
	document.querySelector('.list-widget').classList.add('html5sortable');

	// Add a "disabled" class to rows that should not be sorted
	$('.list-widget tr:has(.disabled)').addClass('disabled');

	// Initialize HTML5Sortable on our tbody
	const sort = document.querySelector('.list-widget tbody');
	$(sort).html5sortable({
		forcePlaceholderSize: true,
		items: ':not(.disabled)'
	});
	// Callback function for when sorting is completed
	$('.list-widget tbody').sortable().bind('sortupdate', function(e) {

		// Trigger the update button
		$(e.target).parents('div.layout-row').find('button.btn-reorder').prop('disabled',false);

		// Remove the "display: block" that gets added to our rows
		$('.list-widget tbody tbody tr').css('display', '');

	});
}

$(function() {
	initializeSorting();
}); 
