
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot</title>

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


$status = '';



	if(!empty($_GET['code']) && isset($_GET['code']) && $_GET['code'] != '0' )
	{	
		$email=$_GET['email'];
		$code=$_GET['code'];
		$c=mysqli_query($connection,"SELECT id FROM user WHERE forgot='$code'");

		if(mysqli_num_rows($c) > 0)
		{
			$count=mysqli_query($connection,"SELECT id FROM user WHERE forgot='$code'");

			$body = '<div class="container">
				<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?code=' . $code . '" method = "post">
				<h1>Welcome to Group K' . "'" . 's Group Scheduling System.</h1>
				<h2 class="form-signin-heading">Change Password.</h2>
				<h3><font color="red" size="3">' . $status . '</font></h3>
				<input type="password" name = "npassword" id = "npassword" class="form-control" placeholder="New Password" required>
				<input type="password" name = "npassword1" id = "npassword1" class="form-control" placeholder="New Password" onkeyup="checkPass(); return false;" required>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="forgot" value = "true">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
				</form>

				<center>Return to the template <a href="template.php">here</a>.</center>
				<center> Already have an account? Login <a href="login.php">here</a>.</center>

				</div> <!-- /container -->'; 
			


		}
		else if(isset($_GET['code']))
		{
			$body ="Incorrect Password reset link. Please resend the email and try again.";
		}
		else if ($_GET['code'] != '0')
		{
			$body = "dont even try";
		}
		if(isset($_POST['npassword']))
		{
			if($_POST['npassword'] == $_POST['npassword1'])
			{
			$password = $_POST['npassword'];
			$salt = uniqid(mt_rand(0,61),true);
			$passhash = crypt($_POST['npassword'],$salt);
			mysqli_query($connection,"UPDATE user SET passhash='$passhash', salt='$salt', forgot='0' WHERE forgot='$code'");
			$body = 'Password Successfully Changed';
			}
		}
	}
	else
	{
	if(isset($_POST['email']))
	{
	$email = $_POST['email'];
	$count=mysqli_query($connection,"SELECT id FROM user WHERE email='$email'");
	if(mysqli_num_rows($count) > 0)
	{
		$status = '<font color="green" size="3">Email exists.</font>';
		$forgot = crypt($email,mt_rand(0,61));
		$salt = uniqid(mt_rand(0,61),true);
		$count = mysqli_query($connection,"UPDATE user SET salt='$salt', forgot='$forgot' WHERE email='$email'");
		require 'smtp/Send_Mail.php';
		Send_Mail($email,"Forgot Password.",'Hello ' . $first_name . ' ' . $last_name . ', <br/> <br/> An attempt to change your password has been made. If this was you click the link below. Otherwise you should contact an administrator. <br/> <br/> <a href="'.$base_url.'forgot.php?code='.$forgot.'">'.$base_url.'forgot.php?code='.$forgot.'</a>');
		echo 'Email Success';
	}
	else
	{
		$status = '<font color="red" size="3">Email does not exist.</font>';
	}


	}
	if(!isset($body)){
		$body = '<div class="container">
		<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '" method = "post">
		<h1>Welcome to Group K' . "'" . 's Group Scheduling System.</h1>
		<h2 class="form-signin-heading">Forgot Password?</h2>
		<h3>' . $status . '</font></h3>
		<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
		<a id = "confirmMessage"></a>
		<input type="hidden" name="forgot" value = "send">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Send Email</button>
		</form>

		<center>Return to the template <a href="template.php">here</a>.</center>
		<center> Already have an account? Login <a href="login.php">here</a>.</center>

		</div> <!-- /container -->'; 
		}
}




?>
<?php echo $body; ?>

	</body>
</html>