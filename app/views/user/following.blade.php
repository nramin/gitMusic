@extends('layouts.loggedin.master')

@section('content')
    @if (sizeof($following) < 1)
    	<h2>Is not following anyone</h2>
    @else
    	<h2>{{ $user }} is following</h2>
	    <ul>
			@foreach ($following as $follower)
				<li>{{ HTML::linkRoute('userProfile', $follower->username, array($follower->username)) }}</li>
			@endforeach
		</ul>
	@endif

@stop