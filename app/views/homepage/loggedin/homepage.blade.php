@extends('layouts.loggedin.master')

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
	@if ($songs)
		@foreach ($songs as $song)
          <div class='song'>
          	<div class="songLine">
            	<h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user, $song->songname)) }}</h2>
            	<p class='songByline'>By<br>Lady the Beard</p>
            </div>
            <div class='box'>
              <div class='songInfo'>
                <img class='download' src='download1.png' alt='chill' />
              </div>
            </div>
          </div>
		@endforeach
	@else
	<h2>Empty Stream :(
	@endif
@stop