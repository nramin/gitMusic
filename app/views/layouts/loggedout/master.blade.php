<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Git Music</title>
        <meta name="description" content="">
        <meta name="author" content="">


        {{ HTML::style('assets/css/loggedout/main.css') }}

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