
<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="functions.js"></script>
  </head>
	<body>
<?php 
//TODO: input validation for forms, make neat like login page ...
$status = '';
if( isset($_POST["create"]))
{
	include 'db.php';

	$username = $_POST['username'];  
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$dob = $_POST['dob'];
	//queries to check to see if username and email already exists
	$result = mysqli_query($connection, "SELECT * FROM user WHERE username='$username'");
	$result2 = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");
	//If it exists tell the user to use another name
	if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0 ) { // The username and email provided are not already in use and email matches email formatso create user row
	$salt = uniqid(mt_rand(0,61),true);
	$passhash = crypt($_POST['password'],$salt);
	$activation = crypt($email,mt_rand(0,61));
	
	$query = "INSERT INTO user ( username, first_name, last_name, email, passhash, salt, DOB, activation) VALUES ( '$username', '$first_name','$last_name','$email','$passhash','$salt', '$dob', '$activation');";
	$result = mysqli_query($connection, $query);
	if(mysqli_affected_rows($connection) == 1) {  //Registration Successful, user row successfully added
		echo 'Thanks for registering!<br>Check your Email for an activation Link!';
		require 'smtp/Send_Mail.php';
		Send_Mail($email,"Email Verification",'Hello ' . $first_name . ' ' . $last_name . ', <br/> <br/> We need to confirm that this is your real email. To do so Click the link below. <br/> <br/> <a href="'.$base_url.'activate.php?code='.$activation.'">'.$base_url.'activate.php?code='.$activation.'</a>');
		echo 'Email Success';
	}
	else {
		$status = 'You could not be registered due to an error, Please try again.';
	}
	}
	else if ( mysqli_num_rows($result) != 0) {
		$status = 'The username you have chosen is in use. Please use another one.';
	}
	else if ( mysqli_num_rows($result2) != 0) {
		$status = 'The email you have chosen is in use. Please use another one.';
	}
	else
	{
		//$status = 'The email you have chosen is invalid.';
	}

}
if(!isset($body))
{
$body = '<div class="container">
	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '" method = "post">
	<h1>Welcome to Group K' . "'" . 's Group Scheduling System.</h1>
	<h2 class="form-signin-heading">Please Register</h2>
	<h3><font color="red" size="3">' . $status . '</font></h3>
	<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
	<input type="text" name = "username" class="form-control" placeholder="User Name" required>
	<input type="password" name = "password" id = "password" class="form-control" placeholder="Password" required>
	<input type="password" name = "password1" id = "password1" class="form-control" placeholder="Password" onkeyup="checkPass(); return false;" required>
	<a id = "confirmMessage"></a>
	<input type=text name = "first_name" class="form-control" placeholder="First Name" required>
	<input type=text name = "last_name" class="form-control" placeholder="Last Name" required>
	Date of Birth : <input type="date" name = "dob" class="form-control">
	<input type="hidden" name="create" value = "true">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>

	<center>Return to the template <a href="template.php">here</a>.</center>
	<center> Already have an account? Login <a href="login.php">here</a>.</center>

	</div> <!-- /container -->';
	}
echo $body;
?>
	</body>
</html>