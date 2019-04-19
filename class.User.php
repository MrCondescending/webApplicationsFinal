<?php
 class User{
   public $username;
   public $firstName;
   public $lastName;
   public $database;

   function __construct($username, $database){
      $this->username = $username;
    	$this->database = $database;

      $sql = file_get_contents('sql/getUser.sql');
    	$params = array(
    		'username' => $this->username
    	);
      $statement = $database->prepare($sql);
  		$statement->execute($params);
  		$customers = $statement->fetchAll(PDO::FETCH_ASSOC);
    	$user = $customers[0];

    	$this->firstName = $user['fname'];
      $this->lastName = $user['lname'];
   }

   function getUsername(){
     return $this->username;
   }

   function getFirstName(){
     return $this->firstName;
   }

   function getLastName(){
     return $this->lastName;
   }

 }
 ?>
