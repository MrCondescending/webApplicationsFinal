<?php
  include('config.php');
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
          <input type="password" id="password" class="fadeIn third" name="login" placeholder="password">
          <input type="password" id="password_verify" class="fadeIn third" name="login" placeholder="re-enter password">
          <input type="submit" class="fadeIn fourth" value="Sign Up">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a><br>
          <a class="underlineHover" href="signup.php"> No Account? Click here to sign up!</a>
        </div>

      </div>
    </div>
  </body>
  <footer>

  </footer>
</html>
