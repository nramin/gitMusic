@extends('layouts.loggedout.master')

@section('content')
	<section id="controls" class="margin">
	    <a href="login" id="login">login</a>
	    <a href="signup" id="signup" class="active">signup</a>
	</section>
	<section class="form">
		<form action="/signup" method="post">
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif
		    <input type="text" name="email" placeholder="Email address" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
		    <input type="password" name="password" placeholder="Password">
		    <input type="password" name="password_again" placeholder="Password Again">
		    <input id='userName' name="username" type="text" placeholder="Username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>
		    {{ Form::token() }}
		    <input id='signup' type="submit" value="Login">
		</form>
	</section>
@stop