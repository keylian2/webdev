<?php
#
# To validate if username exists in the web_users table
#
session_start();
define('DB_NAME', 'keylian');
define('DB_USER', 'xxxxxxx');
define('DB_PASSWORD', 'xxxxxxx');
define('DB_HOST', 'localhost');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
  die('Could not connect: ' .mysqli_error());
   echo json_encode(2);
}
 else{
   $db_selected = mysqli_select_db( $link, DB_NAME);

   if (!$db_selected) {
      die('Could not connect: ' .mysqli_connect_error());
       echo json_encode(2);
    }
    else{
	// parameter "user_name"
       $username = $_POST["user_name"];
       $username = mysqli_real_escape_string($link,$username);

       $sql = "SELECT * FROM web_users WHERE username = '$username'";

       $result = mysqli_query($link, $sql);

       $count = mysqli_num_rows($result);
       if($count == 0) {
         //if the username is NOT taken
         echo json_encode(0); 
       }else {
          //if the username IS taken
             echo json_encode(1);
        }
        mysqli_close($link);
    }


 }

?>
