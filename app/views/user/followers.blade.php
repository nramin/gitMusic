@extends('layouts.loggedin.master')

@section('content')
    <h1 class="page-heading">{{ $user }}'s Followers</h1>
    
    @if (sizeof($followers) < 1)
    	<p>Has no Followers :(</p>
    @else
		@foreach ($followers as $follower)
			<div class="row-user clearfix">
				<?php if ($follower->hasAvatar()) {
					$avatar = 'avatars/' . $follower->pretty_username . '_avatar_small.jpg';
				} else {
					$avatar = 'assets/img/default_small.png';
				} ?>
				<img class="avatar" src="{{ asset($avatar) }}" />
				<span class="right">{{ HTML::linkRoute('userProfile', $follower->username, array($follower->pretty_username)) }}</span>
			</div>
		@endforeach
	@endif

@stop