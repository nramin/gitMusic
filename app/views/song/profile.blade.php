@extends('layouts.loggedin.master')

@section('sidebar')
	@parent
@stop

@section('content')
	{{ HTML::script('assets/js/song.js') }}
	<div id="songpage-title">{{ $song->songname }}</div>
	<div class="songpage-player-wrapper">
	<div id="songpage-player">
     	<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
    </div>
	</div>

	<div id="songpage-details">
		<span>
		@if (count($versions) > 0)
			<h2>Versions:</h2>
				@foreach ($versions as $version)
					<div class="songpage-version">
						{{ HTML::linkRoute('songProfile', $version , array($version->user->username, $version)) }}
					</div>
				@endforeach
		@else
			No versions
		@endif
		</span>
		<span>{{ $song->updated_at }}</span>
		<span>Uploaded by {{ HTML::linkRoute('userProfile', $song->user->username , array($song->user->pretty_username)) }}</span>
		<span>Likes: <span class="song-likes">{{ $song->likes() }}</span></span>
		
		@if (Auth::user())
			@if (Auth::user()->likes_song($song->getId()))
				<h4>You like it also</h4>
			@else
				<span><button class="like-song" data-song-id="<?php echo $song->getId(); ?>">Like</button></span>
			@endif
		@else 
			<span><a href="#">Sign up to like</a></span>
		@endif

	{{ HTML::link($song->zip_url, 'Download Project'); }}
	</div>

	<div id="songpage-comments">
		@if (count($song->comments) > 0)
			<h2>Comments:</h2>
				@foreach ($song->comments as $comment)
					<div class="songpage-comment">
						{{ HTML::linkRoute('userProfile', $comment->user->username , array($comment->user->pretty_username)) }}:
						{{ $comment->content }}
					</div>
				@endforeach
		@else
			<h3>No comments :(</h3>
		@endif
	</div>

@stop