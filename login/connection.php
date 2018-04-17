<?php
$servername = "localhost";
$username = "keylian";
$password = "keylian9188";
$database = "keylian";

$web_user ="steve";
$web_password="steve2";

echo "Test connection ...\n";

$connection = mysqli_connect($servername, $username, $password);

if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
# database: keylian
$select_db = mysqli_select_db($connection, $database);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

$query = "SELECT * FROM `web_users` WHERE username='$web_user' and password='$web_password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){
	print "User validation successful!\n";
}else{
	print "User validation failed!\n";
}

echo "<h2>MySql Connection</h2>";
?>
