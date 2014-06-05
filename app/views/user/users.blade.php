@extends('layouts.loggedin.master')

@section('content')
    <h1 class="page-heading">Artists</h1>
		@foreach ($users as $user)
			<div class="row-user clearfix">
				<?php $avatar = 'avatars/' . $user->pretty_username . '_avatar_small.jpg'; ?>
				<img class="avatar" src="{{ asset($avatar) }}" />
				<span class="right">{{ HTML::linkRoute('userProfile', $user , array($user->pretty_username)) }}</span>
			</div>
		@endforeach
@stop