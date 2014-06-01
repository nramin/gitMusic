<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Git Music</title>
        <meta name="description" content="Music Collabaration, and Discovery">
        <meta name="author" content="GitMusic">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
        
        {{ HTML::style('assets/css/loggedin/main.css') }}
        {{ HTML::style('assets/css/loggedin/circle.css') }}
        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js') }}
        {{ HTML::script('http://d3js.org/d3.v3.min.js') }}
        {{ HTML::script('assets/js/main.js') }}
        {{ HTML::script('assets/js/upload.js') }}
        {{ HTML::script('assets/js/circle.js') }}

        {{ HTML::style('assets/css/jplayer/360player.css') }}
        {{ HTML::style('assets/css/jplayer/flashblock.css') }}
        {{ HTML::style('assets/css/jplayer/360player-visualization.css') }}

        {{ HTML::script('assets/js/soundmanager2.js') }}
        {{ HTML::script('assets/js/berniecode-animator.js') }}
        {{ HTML::script('assets/js/360player.js') }}
        {{ HTML::script('assets/js/bootstrap-player.js') }}

        <script type="text/javascript" src="//use.typekit.net/rqj5dqa.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript" src="//use.typekit.net/jhd1olv.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript" src="//use.typekit.net/lgw5vxn.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        
    </head>

    <body>
    <section id="topbar">
        <a href="{{ route('home') }}" id="logo"></a>
        <div id="username">{{ Auth::user() }}</div>

        @section('topnav')
        <nav>
            <ul>
                <li><a href="#" class="search">Search</a></li>
                <li><a href="#" class="explore ghost">Explore</a></li>
                <li><a href="{{ route('settings') }}" class="settings ghost">Settings</a></li>
                <li><a href="{{ route('logout-get') }}" class="logout ghost">Logout</a></li>
            </ul>
        </nav>
        @show

    </section>

    <section id="sidebar">
        @section('sidebar')

        <?php $current_user = Auth::user(); ?>
        @if ($current_user)
            @if (sizeof($current_user->songs) < 1)
                <p>You have no projects</p>
            @else
                <div class="sidebar-menu-title">Your<br />Projects:
                    <a href="{{ route('upload') }}" class='upload'><img id='addImage' src="{{ asset('assets/img/add.png') }}"></a>
                </div>
                <div class="sidebar-menu-line"></div>
                    @foreach ($current_user->songs as $song)
                    <div class="sidebar-menu-item">
                        {{ HTML::linkRoute('songProfile', '', array($current_user, $song->songname), array('class' => 'sidebar-menu-circle')) }}
                        {{ HTML::linkRoute('songProfile', $song, array($current_user, $song->songname), array('class' => 'sidebar-menu-text')) }}
                    </div>
                    @endforeach
            @endif
        @show

    </section>

    <section id="content">
        
        @yield('content')

    </section>
<!-- 
    <footer id="footer">
       
        @section('footer')
            <h4>This is where we have ourselves a footer</h4>
        @show

    </footer> -->

    </body>
</html>