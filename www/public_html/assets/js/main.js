$(document).ready(function() {

	$('#contact-form').submit(function(e) {
		e.preventDefault();

		$(this).find('button[type=submit]').html('<i class="fa fa-circle-o-notch fa-spin"></i> Sending...');

		var url  = $(this).attr('action'),
			data = $(this).serialize();

		$.post(url, data, function() {
			$('#contact-form').fadeOut(400, function() {
				$('#contact-sent').fadeIn(400);
			});
		});

	});

});