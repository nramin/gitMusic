@extends('layouts.user.master')

@section('sidebar')
	@if (sizeof($current_user->songs) < 1)
    	<p>You have no projects</p>
    @else
    	<div class="sidebar-menu-title">Your Projects:</div>
			@foreach ($current_user->songs as $song)
			<div class="sidebar-menu-item">
				{{ HTML::linkRoute('songProfile', '', array($current_user, $song->songname), array('class' => 'sidebar-menu-circle')) }}
				{{ HTML::linkRoute('songProfile', $song, array($current_user, $song->songname), array('class' => 'sidebar-menu-text')) }}
			</div>
			@endforeach
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