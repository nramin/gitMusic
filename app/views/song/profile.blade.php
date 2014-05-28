@extends('layouts.loggedin.master')

@section('content')
	<h1>Songname: {{ $song->songname }}</h1>
	<p>Artist: {{ HTML::linkRoute('userProfile', $song->user->username , array($song->user->username)) }}</p>
	<p>Likes: {{ $song->likes() }}</p>
	@if (Auth::user())
		@if (Auth::user()->likes_song($song->getId()))
			<h4>You like it also</h4>
		@else
			<button>Like it!</button>
		@endif
	@else 
		<button>Signup to Like it!</button>
	@endif
	
	{{ HTML::style('assets/css/jplayer/360player.css') }}
	{{ HTML::style('assets/css/jplayer/flashblock.css') }}
	{{ HTML::style('assets/css/jplayer/360player-visualization.css') }}

	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js') }}
	{{ HTML::script('assets/js/soundmanager2.js') }}
	{{ HTML::script('assets/js/berniecode-animator.js') }}
	{{ HTML::script('assets/js/360player.js') }}

	<script type="text/javascript">

		soundManager.setup({
		  // path to directory containing SM2 SWF
		  url: '/assets/swf/'
		});

		threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
		threeSixtyPlayer.config.showHMSTime = true;

		// enable some spectrum stuffs

		threeSixtyPlayer.config.useWaveformData = true;
		threeSixtyPlayer.config.useEQData = true;

		// enable this in SM2 as well, as needed

		if (threeSixtyPlayer.config.useWaveformData) {
		  soundManager.flash9Options.useWaveformData = true;
		}
		if (threeSixtyPlayer.config.useEQData) {
		  soundManager.flash9Options.useEQData = true;
		}
		if (threeSixtyPlayer.config.usePeakData) {
		  soundManager.flash9Options.usePeakData = true;
		}

		if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) {
		  // even if HTML5 supports MP3, prefer flash so the visualization features can be used.
		  soundManager.preferFlash = true;
		}

		// favicon is expensive CPU-wise, but can be used.
		if (window.location.href.match(/hifi/i)) {
		  threeSixtyPlayer.config.useFavIcon = true;
		}

		if (window.location.href.match(/html5/i)) {
		  // for testing IE 9, etc.
		  soundManager.useHTML5Audio = true;
		}

	</script>

	<div id="sm2-container">
			<!-- sm2 flash goes here -->
	</div>

	<div>
     	<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"><?php echo $song ?></a></div>
	 	
	</div>

	@if (count($song->comments) > 0)
		<h2>Comments:</h2>
		<ul>
			@foreach ($song->comments as $comment)
				<li>{{ HTML::linkRoute('userProfile', $comment->user->username , array($comment->user->username)) }}</li>
				<li>{{ $comment->content }}</li>
			@endforeach
		</ul>
	@else
		<h3>No comments :(</h3>
	@endif

@stop