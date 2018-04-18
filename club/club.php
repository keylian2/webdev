<!--Author: Steve Yang -->
<!--Log:  -->
<!DOCTYPE HTML>
<html>
<head>
<style>.error {color: #FF0000;}</style>
</head>

<body>

<hr>

<?php session_start();
 if (isset($_SESSION['username']) == FALSE){
   header("Location:http://104.236.52.33/html/test/login.php");
  }

 
// always include the login page for secure access
   echo "Welcome to club!";
   echo "<br>";
   echo "session user: ". $_SESSION['username']; 
?>

<hr>
</body>
</html>

