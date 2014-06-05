@extends('layouts.loggedin.master')

@section('content')

	{{ HTML::script('assets/js/user.js') }}
	{{ HTML::style('assets/css/loggedin/homepage-player.css') }}

	<div class='artistHeaderHolder'>
	<img class='profilePhoto' src="{{ asset('assets/img/caribou.jpg') }}" alt='wow. great pic, girl' />
    	<h1 class='artistHeader'>{{ $user->username }}</h1>
    	@if (Auth::user())
			@if (Auth::user()->following_user($user->getId()))
				<span id='followButton' class='following'>You are following</span>
			@else
				<span id='followButton' class='notFollowing' data-user-id="<?php echo $user->getId(); ?>">Follow</span>
			@endif
		@else 
			<span id='followButton' class='notLoggedIn'><a href="#">Sign up to follow</a></span>
		@endif
    </div>

    <!--
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
				sm2 flash goes here
		</div>
    	-->
	    <ul class='songList'>
			@foreach ($user->songs as $song)
			<div class='song'>
	          	<div class="songLine">
	            	<h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user->pretty_username, $song->pretty_songname)) }}</h2>
	            	<p class='songByline'>By<br>{{$user->username}}</p>
	            </div>
	            @if (isset($song->pic_url))
		            <?php $pic_url = $song->pic_url;?>
		            <div class='box' style="background-image: url('{{ $pic_url }}')">
		              <div class='songInfo'>
		              	<div id="songpage-player">
	     					<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
	    				</div>
		                <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
		              </div>
		            </div>
	            @else
		            <div class='box' style="background-image: url('{{ URL::asset('assets/img/jfk.jpg') }}')">
		              <div class='songInfo'>
		              	<div id="songpage-player">
	     					<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
	    				</div>
		                <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
		              </div>
		            </div>       
	        @endif
          </div>
			@endforeach
		</ul>
	@else 
		<h3>No songs :( </h3>
	@endif
@stop