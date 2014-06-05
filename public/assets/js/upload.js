$(document).ready(uploadHandler);

function uploadHandler(){
	$('#choose-project').click(function() {
		$('#fileProject').click();

	});

	$('#choose-file').click(function() {
		$('#file').click();
	});

	$('#choose-art').click(function() {
		$('#albumArt').click();
	});

	setInterval(function(){
		if($('#fileProject').val() != ''){
			$('#choose-project').css('background-color', 'rgb(7,147,72)');
		}

		if($('#file').val() != ''){
			$('#choose-file').css('background-color', 'rgb(7,147,72)');
		}

		if($('#albumArt').val() != ''){
			$('#choose-art').css('background-color', 'rgb(7,147,72)');
		}
	}, 15)
}