@extends('layouts.user.master')

@section('sidebar')
	@if (sizeof($current_user->songs) < 1)
    	<p>You have no projects</p>
    @else
    	<p>Your Projects:</p>
		<ul>
			@foreach ($current_user->songs as $song)
				<li>{{ HTML::linkRoute('songProfile', $song, array($current_user, $song->songname)) }}</li>
			@endforeach
		</ul>
	@endif
@stop

@section('content')
	<h1>Welcome {{ $current_user->username }}</h1>
	@if ($songs)
		@foreach ($songs as $song)
			<li>{{ HTML::linkRoute('songProfile', $song, array($song->user, $song->songname)) }}</li>
		@endforeach
	@else
	<h2>Empty Stream :(
	@endif
@stop