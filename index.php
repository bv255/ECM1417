<?php
    session_start();
?>

<html>
    <head>
        <title>ECM1417</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
    <body>
        <?php
        include 'navmenu.php';
        ?>
        <div id="main">
            <div id="welcome" class="center">
                <?php
                    if (isset($_COOKIE['username'])) {
                        echo "<h1>Welcome to Pairs ".$_COOKIE['username']."</h1>";
                        echo '<a id="click-to-play" class="btn btn-primary btn-lg btn-block" href="./pairs.php">Click here to play</a>';
                    } else {
                        echo '<p>You\'re not using a registered session? <a href="./registration.php" class="btn btn-link">Register now</a></p>';
                    }
                ?>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
