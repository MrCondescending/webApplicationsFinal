<?php
  include('config.php');
  $username = $_SESSION['username'];
  $user = new User($username, $database);
  $notDone = 1;

  if(isset($_POST['Add_Group'])){
    addGroupToUser($username, $_POST['Add_Group'], $database);
  }
?>
  <script>window.onclick = function(event) {
    if (event.target == document.getElementById('profileModal')) {
      document.getElementById('profileModal').style.display = "none";
    }
  }
  </script>

<!doctype html>
<html lang="en">
  <head>
    <script src="js/modal.js"></script>
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
        </nav>
          <main role="main">
            <!-- Modal content -->
            <div id="profileModal" class="modal">
              <div class="modal-content">
               <div class="modal-header">
                 <span class="close">&times;</span>
                 <h2>Modal Header</h2>
               </div>
               <div class="modal-body">
                 <h2> Group Members: </h2>
                 <?php
                  $users = getUsersInGroup($_GET['group'], $database);
                  foreach($users as $user): ?>
                    <h4><?php echo $user['username'];?></h4>
                    <br>
                 <?php endforeach; ?>

               </div>

              </div>
            </div>
            <div class="container">
            <?php if(isset($_GET['query'])): ?>
              <?php
                $groups = queryForGroups($_GET['query'], $database);
                ?>
                <?php if($groups == Array()): ?>
                  <h2>No Results Found</h2>
                <?php else: ?>
                  <?php foreach($groups as $group): ?>

                    <div style="padding-top:2%;">
                        <h2><?php echo $group['group_name'];?><br>
                        <p style="padding-left:2%;"><?php echo $group['group_description']?><br>
                        <p><a class="btn btn-secondary" href="groups.php?query=<?php echo $_GET['query']?>&group=<?php echo $group['group_name']?>" role="button">View group members &raquo;</a>
                        <form method="POST">
                          <input type="submit" class="btn btn-secondary" name="Add Group" value="<?php echo $group['group_name']?>">
                        </form>
                        <hr style="padding-top:2%;">
                    </div>
                  <?php endforeach;
                endif;
              ?>
            <?php else: ?>
              <div class="row">
                <h2 style="padding-top:3%;"> Please use the search bar above to search for groups </h2>
              </div>
            <?php endif; ?>
            <?php
            if(isset($_GET['group']) && $notDone == 1): ?>
              <script> document.getElementById('profileModal').style.display = "block"; </script>
            <?php
              $notDone = 0;
              endif;
            ?>
          </div>
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

      </body>
</html>
