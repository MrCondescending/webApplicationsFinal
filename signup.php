<?php
  include('config.php');


  $usernameInvalid = false; //For error message about invalid username
  // If form submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	// Get username and password from the form as variables
  	$username = $_POST['login'];
  	$password = $_POST['password'];
    $password_verify = $_POST['password_verify'];
    $date = date('Y-m-d');

    if(validPassword($password, $password_verify) && noUserExists($username, $database)){
      createUser($username, $password, $date, $database);
      createUserGroup($username, $database);
      header('location: login.php');
      die();
    }else {
      $usernameInvalid = true;
    }
  }
 ?>
<html>

  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->
        <br>
        <!-- Login Form -->
        <form method="POST">
          <input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
          <input type="password" id="password" class="fadeIn third" name="password_verify" placeholder="re-enter password">
          <input type="submit" class="fadeIn fourth" value="Sign Up">
        </form>
        <p style="color:red;" ><?php if($usernameInvalid): ?> The username you have selected has already been used, try again</p>
        <?php endif;?>
        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a><br>
          <a class="underlineHover" href="login.php">Return to sign-in</a>
        </div>

      </div>
    </div>
  </body>
  <footer>

  </footer>
</html>
