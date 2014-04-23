@extends('layouts.loggedout.master')

@section('content')
<section id="controls" class="margin">
    <a href="login" id="login">login</a>
    <a href="signup" id="signup" class="active">signup</a>
</section>
<section class="form">
    <input type="text" placeholder="Email address">
    <input type="password" placeholder="Password">
    <input type="text" placeholder="Username">
    <div class="bottom">
        <input type="submit" value="Login">
    </div>
</section>
@stop