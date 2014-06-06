@extends('layouts.loggedin.master')

@section('content')
    <h1>Sorry, we could not find {{ $songname }}</h1>
    <img src="/assets/img/404.png" style="height:500px; width:500px;"/>
@stop