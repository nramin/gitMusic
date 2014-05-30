@extends('layouts.loggedin.master')

@section('sidebar')
	@parent
@stop

@section('content')

	<div id="songpage-title">{{ $song->songname }}</div>

	<div id="sm2-container">
			<!-- sm2 flash goes here -->
	</div>

	<div id="songpage-player">
     	<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
	</div>

	<div id="songpage-details">
		<span>Version: (we need to work on getting this)</span>
		<span>{{ $song->updated_at }}</span>
		<span>Uploaded by {{ HTML::linkRoute('userProfile', $song->user->username , array($song->user->username)) }}</span>
		<span>Likes: {{ $song->likes() }}</span>
		
		@if (Auth::user())
			@if (Auth::user()->likes_song($song->getId()))
				<h4>You like it also</h4>
			@else
				<span><a href="#">Like</a></span>
			@endif
		@else 
			<span><a href="#">Sign up to like</a></span>
		@endif
		<!-- <span><a href="#" >Download</a></span> -->

		{{ HTML::link($song->zip_url, 'Download Project'); }}
	</div>

	<div id="songpage-comments">
		@if (count($song->comments) > 0)
			<h2>Comments:</h2>
				@foreach ($song->comments as $comment)
					<div class="songpage-comment">
						{{ HTML::linkRoute('userProfile', $comment->user->username , array($comment->user->username)) }}:
						{{ $comment->content }}
					</div>
				@endforeach
		@else
			<h3>No comments :(</h3>
		@endif
	</div>
@stop