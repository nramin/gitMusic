@extends('layouts.loggedin.master')

@section('content')
    <h1>Stream {{ $type }}</h1>
    <h3>Songs:</h3>
    <ul>
			@foreach ($songs as $song)
			<li>{{ HTML::linkRoute('songProfile', $song->songname , array($song->user->username, $song->songname)) }}</li>
			@endforeach
	</ul>
@stop