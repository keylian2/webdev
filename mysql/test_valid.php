<?php
  require('connect.php');
  echo "testing database functions ...\n";

  $connection = init_db();


  if (verify_user($connection, "henry", "henry12345")){
	echo "user validated!\n";
   }
  else {
	echo "Invalid user!\n";
   }


?>
