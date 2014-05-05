@extends('layouts.loggedin.master')

@section('content')
	<h1>Songname: {{ $song->songname }}</h1>
	<p>Artist: {{ $song->user->username }}</p>
	<h2>Comments:</h2>
	<ul>
		@foreach ($song->comments as $comment)
			<li>{{ $comment->user->username }}</li>
			<li>{{ $comment->content }}</li>
			@endforeach
	</ul>
@stop