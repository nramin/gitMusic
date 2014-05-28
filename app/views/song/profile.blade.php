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
	
	{{ HTML::style('assets/css/jplayer/not.the.skin.css') }}
	{{ HTML::style('assets/css/jplayer/circle.player.css') }}

	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js') }}
	{{ HTML::script('assets/js/jplayer/jquery.transform2d.js') }}
	{{ HTML::script('assets/js/jplayer/jquery.grab.js') }}
	{{ HTML::script('assets/js/jplayer/jquery.jplayer.js') }}
	{{ HTML::script('assets/js/jplayer/mod.csstransforms.min.js') }}
	{{ HTML::script('assets/js/jplayer/circle.player.js') }}

	<script type="text/javascript">
		$(document).ready(function(){

			var myOtherOne = new CirclePlayer("#jquery_jplayer_2",
			{
				m4a: "<?php echo($song->url); ?>"
			}, {
				cssSelectorAncestor: "#cp_container_2"
			});
		});
	</script>
	
	<div id="jquery_jplayer_2" class="cp-jplayer"></div>

		<div class="music_player"> <!-- A wrapper to emulate use in a webpage and center align -->

			<div id="cp_container_2" class="cp-container">
				<div class="cp-buffer-holder">
					<div class="cp-buffer-1"></div>
					<div class="cp-buffer-2"></div>
				</div>
				<div class="cp-progress-holder">
					<div class="cp-progress-1"></div>
					<div class="cp-progress-2"></div>
				</div>
				<div class="cp-circle-control"></div>
				<ul class="cp-controls">
					<li><a class="cp-play" tabindex="1">play</a></li>
					<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
				</ul>
			</div>
		</div>
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