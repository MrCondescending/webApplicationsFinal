<?php
  include('config.php');

  $username = $_SESSION['username'];
  $user = new User($username, $database);
  $_SESSION['user'] = $user;
  $failedUpdate = false;
  $users_groups = getGroups($user->getUsername(), $database);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['password'] != ""){
      if($_POST['confirmpassword'] == $_POST['password']){
        updateUserPassword($_POST['password'], $username, $database);
      }
      else{
        $failedUpdate = true;
      }
    }
    if($_POST['fname'] != $user->getFirstName() && $_POST['fname'] != ''){
      $user->setFirstName($_POST['fname']);
      updateUserFirstName($_POST['fname'], $username, $database);
    }
    if($_POST['lname'] != $user->getLastName() && $_POST['lname'] != ''){
      $user->setLastName($_POST['lname']);
      updateUserLastName($_POST['lname'], $username, $database);
    }
  }
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
              <li class="nav-item active">
                <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="groups.php">Groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bugs.php">Bug Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
            </ul>
            <form action="logout.php" class="form-inline my-2 my-lg-0">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
            </form>
          </div>
        </nav>

        <!-- Modal content -->
        <div id="profileModal" class="modal">
          <div class="modal-content">
           <div class="modal-header">
             <span class="close">&times;</span>
             <h2>Modal Header</h2>
           </div>
           <div class="modal-body">
             <form method="POST" class="form-horizontal">
               <fieldset>

               <!-- Form Name -->
               <legend>Edit Profile</legend>

               <!-- Text input-->
               <div class="control-group">
                 <label class="control-label" for="fname">First Name</label>
                 <div class="controls">
                   <input id="fname" name="fname" type="text" placeholder="<?php echo $user->getFirstName() ?>" class="input-large">

                 </div>
               </div>

               <!-- Text input-->
               <div class="control-group">
                 <label class="control-label" for="lname">Last Name</label>
                 <div class="controls">
                   <input id="lname" name="lname" type="text" placeholder="<?php echo $user->getLastName() ?>" class="input-large">

                 </div>
               </div>

               <!-- Password input-->
               <div class="control-group">
                 <label class="control-label" for="password">Change Password:</label>
                 <div class="controls">
                   <input id="password" name="password" type="password" placeholder="" class="input-xlarge">

                 </div>
               </div>

               <!-- Password input-->
               <div class="control-group">
                 <label class="control-label" for="confirmpassword">Confirm Password:</label>
                 <div class="controls">
                   <input id="confirmpassword" name="confirmpassword" type="password" placeholder="" class="input-xlarge">

                 </div>
               </div>
              <br>
               <div class="control-group">
                 <div class="form-element">
           				<input type="submit" class="button" />&nbsp;
           				<input type="reset" class="button" />
           			</div>
              </div>

               </fieldset>
               </form>
           </div>

          </div>
        </div>

        <main role="main">

          <!-- Main jumbotron for a primary marketing message or call to action -->
          <div class="jumbotron">
            <div class="container">
              <h1 class="display-3">Hello, <?php if($user->getFirstName() == ''){ echo $user->getUsername();}else{echo $user->getFirstName();}?>!</h1>
              <p>Welcome back to the group calendar! Your account was created on: <?php echo substr($customer['created_date'], 0 , 10) ?></p>
              <button id="profileButton" class="btn btn-primary btn-lg" role="button">Click here to edit your profile &raquo;</button>
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
        </div>
        <footer id="footer" class="container">
          <p>&copy; Devin Workman 2019</p>
        </footer>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/modal.js"></script>
  </body>
</html>
