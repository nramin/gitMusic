@extends('layouts.loggedout.master')

@section('content')
	<section id="controls" class="margin">
	    <a href="login" id="login" class="active">login</a>
	    <a href="signup" id="signup">signup</a>
	</section>
	<section class="form">
		<form action="/login" method="post">
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		    <input type="text" name="username" placeholder="Email address" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>
		    <input type="password" name="password" placeholder="Password">
		    <input type="checkbox" name="remember" id="remember" /> <label for="remember">Remember?</label>
		    <div class="bottom">
		    	{{ Form::token() }}
		        <input type="submit" value="Login">
		        <a href="#">Oops, I forgot my password</a>
		    </div>
		</form>
	</section>
	@if(Session::has('global'))
		{{ Session::get('global') }}
	@endif
@stop