$(document).ready(function() {

	$('#followButton').click(function(){
		if($(this).hasClass('notFollowing')){
			var userId = $(this).data('user-id');
			$.ajax({
			    type: "POST",
			    url: 'http://gitmusic.co/follow',
			    data: {
			  	    'user_id': userId
			    },
			    success: showFollowChange,
			    error: ajaxError
			});
		}
	});

	function showFollowChange() {
		$('.follow-user').hide();
		$('.user-follows').html(parseInt($('.user-follows').html(), 10) + 1);
		var ArtistName = $('.artistHeader').text();
		alert('You Have Successfully Followed ' + ArtistName);
	}

	function ajaxError() {
		alert('error');
	}

});
