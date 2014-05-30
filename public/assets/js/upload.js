
$(document).ready(function(){
	var wrapper = $('<div/>').css({
		'display':'block',
		'color':'white',
		'width':'256px',
		'height':'55px',
		'text-align': 'center',
		'border': '1pt white solid',
		'padding-top': '14px',
		'font-family': 'futura',
		'font-size': '24.53pt'
	});

	var fileInput = $(':file').wrap(wrapper);

	fileInput.change(function(){
	    $this = $(this);
	    $('#file').text($this.val());
	})

	$('#file').click(function(){
	    fileInput.click();
	}).show();
});
	
