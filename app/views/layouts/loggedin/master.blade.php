<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Git Music</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    
    {{ HTML::style('assets/css/loggedin/main.css') }}
    

    
</head>

<body>
<section id="topbar">
    <a href="home" id="logo"></a>
    <div id="username"></div>

    @section('topnav')
    <nav>
        <ul>
            <li><a href="{{ route('upload') }}">Upload</a></li>
            <li><a href="{{ route('settings') }}">Settings</a></li>
            <li><a href="{{ route('logout-get') }}">Logout</a></li>
        </ul>
    </nav>
    @show

</section>

<section id="content">
    @yield('content')
</section>

<footer id="footer">
   
    @section('footer')
        <h4>This is where we have ourselves a footer</h4>
    @show

</footer>

</body>
</html>