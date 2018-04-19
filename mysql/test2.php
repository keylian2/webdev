<?php
  require('connect.php');
  echo "testing database functions ...\n";

  $connection = init_db();


  add_user($connection, "henry", "david@gmail.com", "henry1234", "investor");


?>
