@extends('layouts.loggedin.master')

@section('content')
    <h1>Artist: {{ $user->username }}</h1>
    <h3>Songs:</h3>
    <ul>
			@foreach ($user->songs as $song)
			<li>{{ $song->songname }}</li>
			@endforeach
	</ul>
@stop