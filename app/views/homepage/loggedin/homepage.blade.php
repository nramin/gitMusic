@extends('layouts.loggedin.master')

@section('content')
	<h1>Welcome {{ $current_user->username }}</h1>
@stop