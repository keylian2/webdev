<?php

# -------------------------------------------------------------
function init_db(){

  $servername = "localhost";
  $username = "keylian";
  $password = "keylian9188";
  $database = "keylian";

  $connection = mysqli_connect($servername, $username, $password);

  if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
  }
  # database: keylian
  $select_db = mysqli_select_db($connection, $database);
  if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
  }

  return $connection;
} // init_db


# -------------------------------------------------------------
function verify_user($connection, $username, $password) {

  $query = "SELECT password FROM web_users WHERE username='$username'";

  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row["password"];
	
	echo $hashed_password . "\n";

    if (password_verify($password, $hashed_password)) {
   		// Verified
	$_SESSION['username'] = $username;
	return TRUE;
     }
    else {
	return FALSE;
     }
  }
  else{
	return FALSE;
  }

}// function verify_user


# -------------------------------------------------------------
function add_user($connection, $username, $email, $password, $userrole) {


# hash password and escape
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $hashed_password = mysqli_real_escape_string($connection, $hashed_password);;


  $query = "INSERT INTO web_users (username, email, password, userrole, active, last_update) VALUES ('$username', '$email', '$hashed_password', '$userrole', 1, NOW())";

#  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $result = mysqli_query($connection, $query); 

  echo "add_user: " . $result . "\n";

  if ($result == TRUE){
	echo "New record inserted!\n";
	return TRUE;
  }
  else{
	echo "Error: " .$connection->error . "\n";
	return FALSE;
  }
}// function add_user



?>

