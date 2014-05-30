@extends('layouts.loggedin.master')

@section('content')
    <h1>Artists</h1>
    <ul>
			@foreach ($users as $user)
			<li>{{ HTML::linkRoute('userProfile', $user , array($user->username)) }}</li>
			@endforeach
	</ul>
@stop