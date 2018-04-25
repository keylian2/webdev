<?php
  require('connect.php');
  echo "testing database functions ...\n";

  $connection = init_db();

  verify_user($connection, "henry", "henry12345");

  reset_password($connection, "henry", "henry12345");

  verify_user($connection, "henry", "henry1234");
  verify_user($connection, "henry", "henry12345");

?>
