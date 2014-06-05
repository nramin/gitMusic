<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Git Music</title>
        <meta name="description" content="">
        <meta name="author" content="">


        {{ HTML::style('assets/css/loggedout/main.css') }}

        <script type="text/javascript" src="//use.typekit.net/rqj5dqa.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript" src="//use.typekit.net/jhd1olv.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    </head>
    <body>
        <div id="container">
            <section id="left"></section>
            <section id="right">
                @yield('content')
            </section>
        </div>
    </body>
</html>