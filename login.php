<?php
  include('config.php');
  $failedLogin = false;
  // If form submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	// Get username and password from the form as variables
  	$username = $_POST['login'];
  	$password = $_POST['password'];

  	// Query records that have usernames and passwords that match those in the customers table
  	$sql = file_get_contents('sql/attemptedLogin.sql');
    $params = array (
      'username' => $username,
  		'password' => $password
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
  	// If $users is not empty
  	if(!empty($users)) {
  		// Set $user equal to the first result of $users
      $user = $users[0];
  		// Set a session variable with a key of customerID equal to the customerID returned
  		$_SESSION['username'] = $user['username'];

  		// Redirect to the index.php file
  		header('location: profile.php');
  		die();
  	}
    else{
      $failedLogin = true;
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
          <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
        <p style="color:red;" ><?php if($failedLogin): ?> You have entered an incorrect username and/or password. Please try again.</p>
        <?php endif;?>
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
