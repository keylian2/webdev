<?php
  require('connect.php');
  echo "testing database functions ...\n";

  $connection = init_db();


  # retrieve_user_profiles($connection,  "steve");

  $profiles = retrieve_user_profiles_all($connection);

  print ("# of records = ". count($profiles). "\n");

  foreach ($profiles as $profile ) {

    print("-----------------------\n");
   #  foreach(array_keys($profile) );	

	# print_r ($profile . "\n");
    foreach ($profile as $key => $value ){
	print ($key . "   " . $value . "\n");
      }
   }

  mysqli_close($connection);

?>
