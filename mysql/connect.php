<?php

# -------------------------------------------------------------
function init_db(){

  $servername = "localhost";
  $username = "xxxxxxx";
  $password = "xxxxxxx";
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

	// mysqli_close($connection);
  return $connection;
} // init_db



# -------------------------------------------------------------
# table: web_users
# -------------------------------------------------------------

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
	echo "User validated!\n";
	$_SESSION['username'] = $username;
	return TRUE;
     }
    else {
	echo "###### Invalid User! ######\n";
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


# -------------------------------------------------------------
function reset_password($connection, $username, $password) {


# hash password and escape
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $hashed_password = mysqli_real_escape_string($connection, $hashed_password);;


  $query = "UPDATE web_users SET password = '$hashed_password' WHERE username = '$username' ";

  $result = mysqli_query($connection, $query); 

  echo "reset password: " . $result . "\n";

  if ($result == TRUE){
	echo "Password reset done!\n";
	return TRUE;
  }
  else{
	echo "Error: " .$connection->error . "\n";
	return FALSE;
  }
}// function add_user




# -------------------------------------------------------------
# table: user_profiles
# -------------------------------------------------------------
function add_user_profile($connection, $username, $last_name, $first_name, $other_name, $email, $wechat, $street_address, $street_address2, $city, $state, $zipcode, $country, $phone) {


  $query = "INSERT INTO user_profiles (username, last_name, first_name, other_name, email, wechat, street_address, street_address2, city, state, zipcode, country, phone, create_time, last_update) VALUES ('$username', '$last_name', '$first_name', '$other_name', '$email', '$wechat', '$street_address', '$street_address2', '$city', '$state', '$zipcode', '$country', '$phone', NOW(), NOW())";

  $result = mysqli_query($connection, $query); 

  echo "add_user_profile: " . $result . "\n";

  if ($result == TRUE){
	echo "New record inserted!\n";
	return TRUE;
  }
}// add_user_profile



# -------------------------------------------------------------
function retrieve_user_profiles($connection, $username) {

  $query = "SELECT * FROM user_profiles WHERE username='$username'";

  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    print( "username: " . $row["username"] . "\n");
    print( "address: " . $row["street_address"] . "\n");
   }

}//

# -------------------------------------------------------------
function retrieve_user_profiles_all($connection) {

  $profiles_all = array( array());
  $profile1 = array();

  $query = "SELECT * FROM user_profiles;";

  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count > 0){
	while ( $row = mysqli_fetch_assoc($result)){
#	 $profile1 = array("username" =>$row["username"], "last_name" =>$row["last_name"], "street_address" =>$row["street_address"]);
	$profile1 = $row;
	 array_push($profiles_all, $profile1);
	}
   }// if

   return $profiles_all;

}//

?>

