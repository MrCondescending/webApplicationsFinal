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
    $sql = file_get_contents('sql/createUser.sql');
    $params = array (
      'username' => $username,
      'password' => $password,
      'dateEntry' => $date
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }

  function createUserGroup($username, $database){
    $sql = file_get_contents('sql/createUserGroup.sql');
    $params = array (
      'username' => $username
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }

  function getGroups($username, $database){
    $sql = file_get_contents('sql/getGroups.sql');
    $params = array (
      'username' => $username
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $groups = $statement->fetchAll(PDO::FETCH_ASSOC);
    $groups = $groups[0];
    return $groups;
  }

  function getGroupDescription($groupname, $database){
    $sql = file_get_contents('sql/getGroup.sql');
    $params = array (
      'groupname' => $groupname
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $groups = $statement->fetchAll(PDO::FETCH_ASSOC);
    $group_description = $groups[0];
    $group_description = $group_description['group_description'];
    return $group_description;
  }

  function updateUserPassword($password, $username, $database){
    $sql = file_get_contents('sql/updateUserPassword.sql');
    $params = array (
      'username' => $username,
      'password' => $password
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }

  function updateUserFirstName($firstName, $username, $database){
    $sql = file_get_contents('sql/updateFirstName.sql');
    $params = array (
      'username' => $username,
      'fname' => $firstName
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }

  function updateUserLastName($lastName, $username, $database){
    $sql = file_get_contents('sql/updateLastName.sql');
    $params = array (
      'username' => $username,
      'lname' => $lastName
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
  }

  function queryForGroups($query, $database){
    $sql = file_get_contents('sql/queryGroups.sql');
    $params = array (
      'query' => "%" . $query . "%"
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $groups =  $statement->fetchAll(PDO::FETCH_ASSOC);
    return $groups;
  }

  function getUsersInGroup($query, $database){
    $sql = file_get_contents('sql/getUsersInGroup.sql');
    $params = array (
      'query' => "%" . $query . "%"
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $users =  $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }
