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
		for(var i = 0; i < data.length; i++){
			$song = $('<div>')
				.addClass('song');

			$songLine = $('<div>')
				.addClass('songLine');

			$h2 = $('<h2>')
				.addClass('songHeader')
				.text(data.songname);

			$p = $('<p>')
				.addClass('songByline')
				.text('Lady the Beard');

			$songLine
				.append($h2)
				.append($p);

			$song.append($songLine)




			$holder = $('<div>')
				.addClass('box')
				.css('background-image', data.pic_url)

			$songInfo = $('<div>')
				.addClass('songInfo');

			$songpagePlayer = $('<div>')
				.attr('id', 'songpage-player');

			$ui360 = $('<div>')
				.addClass('ui360')
				.addClass('ui360-vis');

			$a = $('<a>')
				.attr('href', data.url);


			$img = $('<img>')
				.addClass('download')
				.attr('src', 'download.png')
				.attr('alt', 'chill');

			$songpagePlayer
				.append($ui360)
				.append($a)

			$songInfo
				.append($songpagePlayer)
				.append($img);

			$holder.append($songInfo);

			$song.append($holder);

			$('#songHolder').append($song);


		}
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

