@extends('layouts.loggedin.master')

@section('content')
    @if (sizeof($likedSongs) < 1)
    	<h2>Has not liked any songs.</h2>
    @else
    	<h2>{{ $user }} has liked</h2>
	    <ul>
			@foreach ($likedSongs as $song)
				<li>{{ HTML::linkRoute('songProfile', $song, array($song->user, $song)) }}</li>
			@endforeach
		</ul>
	@endif

@stop