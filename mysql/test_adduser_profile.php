<?php
  require('connect.php');
  echo "testing database functions ...\n";

  $connection = init_db();


  add_user_profile($connection, "henry", "Henry", "Smith", "", "henry@gmail.com", "wechat102", "223 Main Ave", "", "Danbury", "CT", "10023", "USA", "203-544-2323");


?>
