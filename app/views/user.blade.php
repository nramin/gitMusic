<html>
    <body>
        <h1>Hello, <?php echo $user->username; ?></h1>
        <p><?php echo serialize($user) ?></p>
        <p><?php echo serialize($songs) ?></p>
    </body>
</html>