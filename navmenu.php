
<?php
  session_start();
?>


  <nav class="navbar navbar-expand-lg navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="index.php" name="home">Home</a>
        </div>
        <div class="navbar-nav ms-auto">
          <?php 
            if(isset($_COOKIE['username'])) {
              echo '
              <a class="nav-item nav-link" href="pairs.php" name="memory">Play Pairs</a>
              <a class="nav-item nav-link" href="leaderboard.php" name="leaderboard">Leaderboard</a>
            ';
            } else {
              echo '<a class="nav-item nav-link" href="registration.php" name="register">Register</a>';
            }
          ?>
        </div>
      </div>
    </nav>
