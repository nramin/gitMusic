@extends('layouts.loggedin.master')

@section('content')
    <h1>{{ $user }}'s Followers</h1>
    
    @if (sizeof($followers) < 1)
    	<p>Has no Followers :(</p>
    @else
	    <ul>
			@foreach ($followers as $follower)
				<li>{{ HTML::linkRoute('userProfile', $follower->username, array($follower->pretty_username)) }}</li>
			@endforeach
		</ul>
	@endif

@stop