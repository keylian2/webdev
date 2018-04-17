<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
//start the session
session_start();

// define variables and set to empty values
$usernameErr = $passwordErr = $recaptchaErr = $validateErr ="";
$username = $password = "";

if(isset($_POST['submit']) && !empty($_POST['submit'])){

	// form validations
     if ($_SERVER["REQUEST_METHOD"] == "POST") {

	  if (empty($_POST["username"])) {
	    $usernameErr = "User Name is required";
	  } else {
	    $username = test_input($_POST["username"]);
	    // check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
	      $usernameErr = "Only letters and white space allowed"; 
	    }
	  }
  
	  if (empty($_POST["password"])) {
	    $passwordErr = "Password is required";
	  } else {
	    $password = test_input($_POST["password"]);
	    // check if e-mail address is well-formed
	    }
	} // if POST


    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
        $secret = '6Lde2VMUAAAAAC0qQ1Pk--3Ulj7cmHHZ3Lkc5LmU';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

	if($responseData->success){
		$recaptchaErr = "Form successful!";

	  if (verify_user($username, $password)){
		#$validateErr = "Login name validated!";
		header("Location: hello.html");
		exit();
	   }
	  else {
		$validateErr = "User validation failed!"; 
	  }

	} // if $responseData->success
	else{
		$recaptchaErr = "Robot verifiation failed, please try again.";
	}
	}// if get-recaptcha-response
    else {
		$recaptchaErr = "Please verify I am not a robot.";
    }

}// if submit



function verify_user($username, $password) {
#  database connections
  $connection = mysqli_connect('localhost', 'keylian', 'keylian9188');
  if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
  }
  # database: keylian
  $select_db = mysqli_select_db($connection, 'keylian');
  if (!$select_db){
     die("Database Selection Failed" . mysqli_error($connection));
  }

  $query = "SELECT * FROM `web_users` WHERE username='$username' and password='$password'";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $count = mysqli_num_rows($result);

  if ($count == 1){
	$_SESSION['username'] = $username;
	return TRUE;
  }
  else{
	return FALSE;
  }

}// function verify_user


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>




<h2>Login Form</h2>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  Password: <input type="text" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
    <div class="g-recaptcha" data-sitekey="6Lde2VMUAAAAALXu21tPon_KL2vwd_OPwlKBYj9F"></div>
  <span class="error">* <?php echo $recaptchaErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>

<?php
echo $validateErr; 
echo "<br>"
?>

