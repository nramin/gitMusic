@extends('layouts.loggedin.master')

@section('content')
	<h1>Songname: {{ $song->songname }}</h1>
	<p>Artist: {{ HTML::linkRoute('userProfile', $song->user->username , array($song->user->username)) }}</p>
	<p>Likes: {{ $song->likes }}</p>
	<p>Favorites: {{ $song->favorites }}</p>
	<h2>Comments:</h2>
	<ul>
		@foreach ($song->comments as $comment)
			<li>{{ HTML::linkRoute('userProfile', $comment->user->username , array($comment->user->username)) }}</li>
			<li>{{ $comment->content }}</li>
			@endforeach
	</ul>
@stop