<?php
  include('config.php');
  include('class.User.php');
  $username = $_SESSION['username'];
  $user = new User($username, $database);

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
    <div id="page-container">
      <div id="content-wrap">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <a class="navbar-brand" href="#">Navigate</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="groups.php">Groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bugs.php">Bug Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
            </ul>
            <form id="search-bar" method="GET" class="form-inline my-2 my-md-0">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="query">
            </form>
            <h4 style="color:white;padding-right:10px;"> <?php echo $user->getFirstName() ?></h4>
            <form action="logout.php" class="form-inline my-2 my-lg-0">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
            </form>
          </div>
          </div>
          <main role="main">

          </main>

          <footer id="footer" class="container">
            <p>&copy; Devin Workman 2019</p>
          </footer>
        </div>
      </body>
</html>
