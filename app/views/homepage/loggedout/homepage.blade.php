@extends('layouts.loggedout.master')

@section('content')
	<section class="form" id="login">
		<form action="login" method="post">
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		    <input type="text" name="username" placeholder="Username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>
		    <input type="password" name="password" placeholder="Password">
		    <!--<input type="checkbox" name="remember" id="remember" /> <label for="remember">Remember?</label>-->
		    	{{ Form::token() }}
		        <input type="submit" value="Login">
		        <!--<a href="#">Oops, I forgot my password</a>-->
		</form>
	</section>
	<section id="description">
		<h2>Git Music</h2>
		<p id='introDescription'>Download other artists' music projects for free.<br />Share your own, see other people change it.</p>
	</section>
	<section class="form" id="signup">
		<form action="signup" method="post">
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
		    <input type="text" name="username" placeholder="Username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>
		    <input type="password" name="password" placeholder="Password">
		    <input type="password" name="password_again" placeholder="Password Again">
		    {{ Form::token() }}
		    <input type="submit" value="Signup">
		</form>
	</section>
	@if(Session::has('global'))
		{{ Session::get('global') }}
	@endif
@stop