@extends('layouts.loggedin.master')

@section('content')

	{{ HTML::script('assets/js/user.js') }}

    <h1>Artist: {{ $user->username }}</h1>
   	<span>Followers: <span class="user-follows">{{ $user->followers }}</span></span>
   		@if (Auth::user())
			@if (Auth::user()->following_user($user->getId()))
				<h4>You are following</h4>
			@else
				<span><button class="follow-user" data-user-id="<?php echo $user->getId(); ?>">Follow</button></span>
			@endif
		@else 
			<span><a href="#">Sign up to follow</a></span>
		@endif
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