<?php
  include('config.php');

  $username = $_SESSION['username'];
  $user = new User($username, $database);
  $_SESSION['user'] = $user;

  $users_groups = getGroups($user->getUsername(), $database);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/profile.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navigate</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Groups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Bug Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
        <form action="logout.php" class="form-inline my-2 my-lg-0">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
        </form>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hello, <?php if($user->getFirstName() == ''){ echo $user->getUsername();}else{echo $user->getFirstName();}?>!</h1>
          <p>Welcome back to the group calendar! Your account was created on: <?php echo substr($customer['created_date'], 0 , 10) ?></p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Click here to edit your profile &raquo;</a></p>
        </div>
      </div>

      <?php if($users_groups['groups'] != ''): ?>
        <div class="container">
          <!-- Example row of columns -->
          <?php
            $groups_arr = explode(';', $users_groups['groups']);?>


            <div class="row">
              <?php foreach($groups_arr as $group): ?>
              <div class="col-md-4">
                <h2><?php echo $group; ?></h2>
                <p><?php echo getGroupDescription($group, $database); ?></p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
              </div>
              <?php endforeach; ?>
            </div>

          <hr>

        </div> <!-- /container -->
      <?php else: ?>
        <div class="row">
          <div class="col-md-4">
            <center><p>It seems that you have not added any groups yet! Click the "Groups" button on the top bar to search for groups to add!</p>
          </div>
        </div>
      <?php endif;?>
    </main>

    <footer class="container">
      <p>&copy; Devin Workman 2019</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
