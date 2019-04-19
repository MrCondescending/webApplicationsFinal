<?php

// Connecting to the MySQL database
$username = 'workmand1';
$password = 'tRuvucH6';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring19_workmand1', $username, $password);

include('vendor/autoload.php');

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page
if(!isset($_SESSION['username']) && !($current_url == 'login.php' || $current_url == 'signup.php')){
  header('location: login.php');
  die();
}
// Else if session key customerID is set get $customer from the database
elseif(isset($_SESSION['username'])){
  $sql = file_get_contents('sql/getUser.sql');
  $params = array(
    'username' => $_SESSION['username']
  );
  $statement = $database->prepare($sql);
  $statement->execute($params);
  $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
  $customer = $customer[0];
}
?>
