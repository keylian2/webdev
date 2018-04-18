# Connect to the database
# Create a file with name connect.php. 
# User correct database name ,  user credentials.

<?php
$connection = mysqli_connect('localhost', 'keylian', 'keylian9188');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'keylian');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
