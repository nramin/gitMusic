@extends('layouts.loggedin.master')

@section('content')
	<h1>Songname: {{ $song->songname }}</h1>
	<p>Artist: {{ HTML::linkRoute('userProfile', $song->user->username , array($song->user->username)) }}</p>
	<p>Likes: {{ $song->likes() }}</p>
	@if (Auth::user()->likes_song($song->getId()))
		<h4>You like it also</h4>
	@else 
		<button>Like it!</button>
	@endif
	<h2>Comments:</h2>
	<ul>
		@foreach ($song->comments as $comment)
			<li>{{ HTML::linkRoute('userProfile', $comment->user->username , array($comment->user->username)) }}</li>
			<li>{{ $comment->content }}</li>
		@endforeach
	</ul>

@stop