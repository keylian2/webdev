<?php
	$password = "hello!";
	echo $password . "\n";

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	echo $hashed_password . "\n";

?>
