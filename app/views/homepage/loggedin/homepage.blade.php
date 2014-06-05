@extends('layouts.loggedin.master')

@section('sidebar')
	@parent
@stop

@section('content')
	{{ HTML::style('assets/css/loggedin/homepage-player.css') }}
	<h1 id='streamHeader'>Stream</h1>
	@if ($songs)
		@foreach ($songs as $song)
          <div class='song'>
          	<div class="songLine">
            	<h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user->pretty_username, $song->pretty_songname)) }}</h2>
            	<p class='songByline'><a href="{{$song->user->username}}">By<br>{{$song->user->username}}</a></p>
            </div>
            @if (isset($song->pic_url))
	            <?php $pic_url = $song->pic_url;?>
	            <div class='box' style="background-image: url({{ $pic_url }})">
	              <div class='songInfo'>
	              	<div id="songpage-player">
     					<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
    				</div>
	                <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
	                <div class="songInfoLikes">likes</div>
	              </div>
	            </div>
            @else
	            <div class='box' style="background-image: url('{{ URL::asset('assets/img/jfk.jpg') }}')">
	              <div class='songInfo'>
	              	<div id="songpage-player">
     					<div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
    				</div>
	                <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
	                <div class="songInfoLikes">{{ $song->likes }} likes</div>
	              </div>
	            </div>
	        @endif
          </div>
		@endforeach
	@else
		<h2>You are not currently following anyone.</h2>
		{{ HTML::linkRoute('explore', 'Check out our explore page!') }}
	@endif
@stop