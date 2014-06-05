$(document).ready(function() {
	$('#avatar-image-button').click(function() {
		$('#avatar-image').click();
	});
	setInterval(function() {
		if ($('#avatar-image').val() != '') {
			$('#avatar-image-button').css('background-color', 'rgb(7,147,72');
		}
	}, 15);
});