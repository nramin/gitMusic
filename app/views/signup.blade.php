@extends('layouts.loggedout.master')

@section('content')
<section id="controls" class="margin">
    <a href="login" id="login">login</a>
    <a href="signup" id="signup" class="active">signup</a>
</section>
<section class="form">
    <input type="text" placeholder="Email address">
    <input type="password" placeholder="Password">
    <input id='userName' type="text" placeholder="Username">
    <input id='signup' type="submit" value="Login">
</section>
@stop