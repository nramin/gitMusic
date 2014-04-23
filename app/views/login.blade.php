@extends('layouts.loggedout.master')

@section('content')
<section id="controls" class="margin">
    <a href="login" id="login" class="active">login</a>
    <a href="signup" id="signup">signup</a>
</section>
<section class="form">
    <input type="text" placeholder="Email address">
    <input type="password" placeholder="Password">
    <div class="bottom">
        <input type="submit" value="Login">
        <a href="#">Oops, I forgot my password</a>
    </div>
</section>
@stop