@extends('layouts.loggedin.master')

@section('sidebar')
	@parent
@stop

@section('content')
	@if ($songs)
		@foreach ($songs as $song)
          <div class='song'>
          	<div class="songLine">
            	<h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user, $song->songname)) }}</h2>
            	<p class='songByline'>By<br>Lady the Beard</p>
            </div>
            <div class='box' style="background-image: url('/assets/img/jfk.jpg'); background-repeat: no-repeat;">
              <div class='songInfo'>
                <img class='download' src='download.png' alt='chill' />
              </div>
            </div>
          </div>
		@endforeach
	@else
		<h2>You are not currently following anyone.</h2>
		{{ HTML::linkRoute('explore', 'Check out our explore page!') }}
	@endif
@stop