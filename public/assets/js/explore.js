$(document).ready(function() {

	$genres = $('.genreExplore li');
	$genres.click(populateGenre);

});

function populateGenre(){
	$('#selectedGenre').removeAttr('id');
	$this = $(this);
	$this.attr('id', 'selectedGenre');

	var genreId = $this.attr('data-genreId');

	
	$.get( "/songs/genre/hottest/" + genreId , function( data ) {
		console.log(data);
		$('.song').remove();

		console.log(data[0]);
		for(var i = 0; i < data.length; i++){
			$song = $('<div>')
				.addClass('song');

			$songLine = $('<div>')
				.addClass('songLine');

			$h2 = $('<h2>')
				.addClass('songHeader')
				.text(data[i].songname);

			$p = $('<p>')
				.addClass('songByline')
				.text('Lady the Beard');

			$songLine
				.append($h2)
				.append($p);

			$song.append($songLine)



			var pic_url = 'http://gitmusic.dev/assets/img/jfk.jpg';
			if(data[i].pic_url)
				pic_url = data[i].pic_url;

			$holder = $('<div>')
				.addClass('box')
				.css('background-image', 'url(' + pic_url + ')');

			$songInfo = $('<div>')
				.addClass('songInfo');

			$songpagePlayer = $('<div>')
				.attr('id', 'songpage-player');

			$ui360 = $('<div>')
				.addClass('ui360')
				.addClass('ui360-vis')
				.css('background-image', 'none');

			$a = $('<a>')
				.attr('href', data[i].url);

			$ui360.append($a);


			$img = $('<img>')
				.addClass('download')
				.attr('src', 'http://gitmusic.dev/assets/img/downloadWhite.png')
				.attr('alt', 'chill');

			$songpagePlayer
				.append($ui360);

			$songInfo
				.append($songpagePlayer)
				.append($img);

			$holder.append($songInfo);


			$song.append($holder);

			$('#songHolder').append($song);


		}
		threeSixtyPlayer.init();
	});

}

/*
<div class='song'>
    <div class="songLine">
        <h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user->pretty_username, $song->pretty_songname)) }}</h2>
        <p class='songByline'>By<br>Lady the Beard</p>
    </div>

/*
<?php $pic_url = $song->pic_url;?>
    <div class='box' style="background-image: url('{{ $pic_url }}')">
      <div class='songInfo'>
        <div id="songpage-player">
            <div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
        </div>
        <img class='download' src='download.png' alt='chill' />
      </div>
    </div>
*/

