@extends('layouts.user.master')

@section('content')

    <h1>Artist: {{ $user->username }}</h1>
    @if (count($user->songs) > 0)
	    <div id="sm2-container">
				<!-- sm2 flash goes here -->
		</div>
    	<h3>Songs:</h3>
	    <ul>
			@foreach ($user->songs as $song)
				<div id="userpage-player">
     				<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
				</div>
				<li>{{ HTML::linkRoute('songProfile', $song->songname , array($user->username, $song->songname)) }}</li>
			@endforeach
		</ul>
	@else 
		<h3>No songs :( </h3>
	@endif
@stop