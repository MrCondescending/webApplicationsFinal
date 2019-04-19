<?php
  function validPassword($password, $verify_password){
    if($password == $verify_password){
      return true;
    }
    else{
      return false;
    }
  }

  function noUserExists($username, $database){
    $sql = file_get_contents('sql/getUser.sql');
    $params = array (
      'username' => $username
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    // If $users is not empty
    if(!empty($users)) {
      return false;
    }
    else{
      return true;
    }
  }

  function createUser($username, $password, $date, $database){
    // Query records that have usernames and passwords that match those in the customers table
    $sql = file_get_contents('sql/createUser.sql');
    $params = array (
      'username' => $username,
      'password' => $password,
      'dateEntry' => $date
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }
