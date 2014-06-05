
var showing = false;
$(document).ready(function(){
	$('#addVersionCircle').click(showUploader);
	$('body').click(closeUploaderHandler);

});

function closeUploaderHandler(event){
	var targetId = $(event.target).attr('id');
	if(targetId == 'whiteOverlay')
		closeUploader();
}

function showUploader(){
	if(!showing){
		$form = $('<form>')
				.attr('id', 'versionForm');

		$form.submit(false);

		$overlay = $('<div>').attr('id', 'whiteOverlay');
		$('body').append($overlay)
				.hide()
				.fadeIn();

		$h1 = $('<h1>')
			.attr('id', 'versionAppenderHeader')
			.text('upload');

		$holder = $('<div>').attr('id', 'versionAppenderHolder');

		$project = $('<input>').attr({
			'type': 'file',
			'name': 'projectfile',
			'accept': 'application/zip',
			'id': 'fileProject' 
		})
		.addClass('file-field');

		$submit = $('<input>').attr({
			'type': 'submit',
			'value': 'Upload',
			'id': 'submit'
		})
		.addClass('button')
		.click(submitInfo);

		$mp3 = $('<input>').attr({
			'type': 'file',
			'name': 'songfile',
			'accept': 'audio/*',
			'id': 'file' 
		})
		.addClass('file-field');

		$chooseProject = $('<div>')
			.attr('id', 'choose-project')
			.text('Choose Project');

		$chooseFile = $('<div>')
			.attr('id', 'choose-file')
			.text('Choose song');

		$holder.append($h1)
				.append($project)
				.append($mp3)
				.append($chooseProject)
				.append($chooseFile)
				.append($submit);

		$form.append($holder)

		$('body').append($form);
		$holder.hide().fadeIn();
	} else {
		$('#versionAppenderHolder').fadeOut()
			.remove();
		$('#whiteOverlay').fadeOut()
			.remove();
	}
	showing = !showing;

	uploadHandler();
}

function closeUploader(){
	$('#versionAppenderHolder').fadeOut()
			.remove();
		$('#whiteOverlay').fadeOut()
			.remove();
}

function submitInfo(){
	var fd = new FormData(document.getElementById("versionForm"));
	console.log(fd);
	fd.append('song_id', parseInt($('#idHide').text()));
    $.ajax({
      url: "http://gitmusic.dev/version-upload",
      type: "POST",
      data: fd,
      processData: false,  
      contentType: false  
    }).done(function (result) {
      closeUploader();
    });

}


//<div id="choose-project">Choose project</div>
//<input type="file" class="file-field" name="projectfile" accept="application/zip" id="fileProject">
//<input type="file" class="file-field" name="songfile" accept="audio/*" id="file">
//<input type="submit" value="Upload" class="button" id="submit">