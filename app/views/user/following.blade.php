@extends('layouts.loggedin.master')

@section('content')
    @if (sizeof($following) < 1)
    	<h2>Is not following anyone</h2>
    @else
    	<h1 class="page-heading">{{ $user }} is following</h1>
	    <ul>
			@foreach ($following as $follower)
			<div class="row-user clearfix">
				<?php $avatar = 'avatars/' . $follower->pretty_username . '_avatar_small.jpg'; ?>
				<img class="avatar" src="{{ asset($avatar) }}" />
				<span class="right">{{ HTML::linkRoute('userProfile', $follower->username, array($follower->pretty_username)) }}</span>
			</div>
			@endforeach
		</ul>
	@endif

@stop