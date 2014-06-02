var searchHidden = true;

$(document).ready(function() {

	sidebar_height();
	$( window ).resize(function() {
		sidebar_height();
	});

	$('.search').click(revealSearchBar);

	//$('#username').hover(expandOptionBar, resizeOptionBar);

	function sidebar_height() {
		var page_height = $(window).height();
		var topbar_height = $('#topbar').height();
		$('#sidebar').css('height', page_height - topbar_height);
	}

	function revealSearchBar(){
		if(searchHidden){
			$searchBox = $('<section>').attr('id', 'searchBox');
			$input = $('<input>').attr('id', 'searchInput')
			$searchBox.append($input);

			$('body').append($searchBox);
			$('#searchBox').animate({'height': '43px'});
			$input.focus();
		} else {
			$('#searchInput').animate({'height': '0px'})
			$('#searchBox').animate({'height': '0px'}, 1000,function(){
				$('#searchInput').remove();
				$(this).remove();
			});
		}
		searchHidden = !searchHidden;
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