$(document).ready(function() {

	sidebar_height();
	$( window ).resize(function() {
		sidebar_height();
	});

	$('.like-song').click(function(){
		var songId = $(this).data('song-id');
		$.ajax({
		  type: "POST",
		  url: 'http://107.170.219.35/song-like',
		  data: {
		  	'song_id': songId
		  },
		  success: showLikeChange,
		  error: ajaxLikeError
		});
	});

	//$('#username').hover(expandOptionBar, resizeOptionBar);

	function sidebar_height() {
		var page_height = $(window).height();
		var topbar_height = $('#topbar').height();
		$('#sidebar').css('height', page_height - topbar_height);
	}

	function expandOptionBar(event){
		console.log('duba');
		$(this).animate({'width':'92px'});
		event.stopPropagation();
	}

	function resizeOptionBar(event){
		$(this).animate({'width':'450px'});
		event.stopPropagation();
	}
});