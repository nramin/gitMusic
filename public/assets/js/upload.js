
$(document).ready(function(){
	var wrapper = $('<div/>').css({
		'display':'block',
		'color':'white',
		'width':'256px',
		'height':'55px',
		'text-align': 'center',
		'border': '1pt white solid',
		'padding-top': '14px',
		'margin-top': '30px',
		'font-family': 'futura',
		'font-size': '24.53pt',
		'margin-left': '103px'
	});


	var fileInput = $(':file').wrap(wrapper);

	fileInput.change(function(){
	    $this = $(this);
	    $('#fileWrapperSong').text($this.val());
	})

	$('#fileWrapperSong').click(function(){
	    fileInput.click();
	}).show();
});
	
