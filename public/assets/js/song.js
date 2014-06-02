$(document).ready(function() {
	
	$('.like-song').click(function(){
			var songId = $(this).data('song-id');
			$.ajax({
			  type: "POST",
			  url: 'http://107.170.219.35/song-like',
			  data: {
			  	'song_id': songId
			  },
			  success: showLikeChange,
			  error: ajaxError
			});
		});

	function showLikeChange() {
		$('.like-song').hide();
		$('.song-likes').html(parseInt($('.song-likes').html(), 10) + 1);
		alert('You Liked That Shit?!');
	}

	function ajaxError() {
		alert('something fucked up');
	}
});