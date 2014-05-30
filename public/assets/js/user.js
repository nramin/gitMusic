$(document).ready(function() {

	$('.follow-user').click(function(){
		var userId = $(this).data('user-id');
		$.ajax({
		    type: "POST",
		    url: 'http://107.170.219.35/follow',
		    data: {
		  	    'user_id': userId
		    },
		    success: showFollowChange,
		    error: ajaxError
		});
	});

	function showFollowChange() {
		$('.follow-user').hide();
		$('.user-follows').html(parseInt($('.user-follows').html(), 10) + 1);
		alert('You Liked That Shit?!');
	}

	function ajaxError() {
		alert('something fucked up');
	}

});
