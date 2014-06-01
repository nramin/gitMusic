@extends('layouts.loggedin.master')

@section('sidebar')
	@if (sizeof($current_user->songs) < 1)
    	<p>You have no projects</p>
    @else
    	<div class="sidebar-menu-title">Your Projects:</div>
			@foreach ($current_user->songs as $song)
			<div class="sidebar-menu-item">
				{{ HTML::linkRoute('songProfile', '', array($current_user, $song->pretty_songname), array('class' => 'sidebar-menu-circle')) }}
				{{ HTML::linkRoute('songProfile', $song, array($current_user, $song->pretty_songname), array('class' => 'sidebar-menu-text')) }}
			</div>
			@endforeach
	@endif
@stop

@section('content')
	@if ($songs)
		@foreach ($songs as $song)
          <div class='song'>
          	<div class="songLine">
            	<h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->pretty_username, $song->pretty_songname)) }}</h2>
            	<p class='songByline'>By<br>Lady the Beard</p>
            </div>
            @if (isset($song->pic_url))
	            <?php $pic_url = $song->pic_url;?>
	            <div class='box' style="background-image: url('{{ $pic_url }}')">
	              <div class='songInfo'>
	                <img class='download' src='download.png' alt='chill' />
	              </div>
	            </div>
            @else
            	<?php $pic_url = $song->pic_url;?>
	            <div class='box' style="background-image: url('{{ URL::asset('assets/img/jfk.jpg') }}')">
	              <div class='songInfo'>
	                <img class='download' src='download.png' alt='chill' />
	              </div>
	            </div>
	        @endif
          </div>
		@endforeach
	@else
	<h2>Empty Stream :(
	@endif
@stop