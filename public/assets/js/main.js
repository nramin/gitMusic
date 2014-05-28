$(document).ready(function() {
	var page_height = $(window).height();
	var topbar_height = $('#topbar').height();
	$('#sidebar').css('height', page_height - topbar_height);
});