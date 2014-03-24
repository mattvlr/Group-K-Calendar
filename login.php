<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
  </head>
	<body>
		<?php

		if(isset($_COOKIE["id"]))
		{
			$body = 'cookie check success<br>Here we should redirect to the userpage.<br>';
		}
		else if(isset($_COOKIE["wait"]))
		{
			$body =  "You have tried too many times to login. Please wait another " . floor(($_COOKIE["wait"]-time())/60)  . " minutes " . ($_COOKIE["wait"]-time())%60 . " seconds and try again.<br>";
		}
		if(!isset($_POST["login"]))
		{
			$email = 'Email Address';
			$attempts = 0;
		}
		else
		{
			include 'db.php';
			$email = $_POST["email"];
			$attempts = $_POST["attempts"];
			$password = $_POST["password"];
			$result = mysqli_query($connection, "SELECT id, passhash , salt FROM user WHERE email='$email'");

			while($row = mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$passhash = $row['passhash'];
				$salt = $row['salt'];
			}
			$testhash = crypt($password,$salt);

			if($passhash == $testhash)
			{
				echo 'login success<br>Here we should redirect to the userpage.<br>';
				$body = '';
				if($_POST['remember'] == 'true')
				{
					setcookie("id", $id , false);
				}
			}
			else if($passhash == NULL)
			{
				$status = "<font color='red' size='3'>Email not found.</font>";
				$email = "Email address";

			}
			else if($attempts < 10)
			{
				$attempts = $attempts + 1;
				$status = "<font color='red' size='3'>Incorrect email\password combination.</font>";
			}
			else if($attempts >= 10)
			{
				$body = "You have tried too many times to login. Please wait 15 minutes and try again.";
				setcookie("wait", time()+60*15 ,time()+60*15);
			}
		}

		if(!isset($body))
		{
		$body = '<div class="container">
				<form class="form-signin" role="form" action="login.php" method = "post">
				<h1>Welcome to Group K' . "'" . 's Group Scheduling System.</h1>
				<h2 class="form-signin-heading">Please sign in</h2>
				<h3>' . $status . '</h3>
				<input type="email" name = "email" class="form-control" value="' . $email . '" required autofocus>
				<input type="password" name = "password" class="form-control" placeholder="Password" required>
				<input type="hidden" name="login" value = "true">
				<input type="hidden" name="attempts" value ="' . $attempts . '">
				<label class="checkbox">
				<input type="checkbox" name = "remember" value="true"> Remember me
				</label>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				</form>

				<center>Return to the template <a href="template.php">here</a>.</center>
				<center> Dont have an account? Register <a href="register.php">here</a>.</center>

				</div> <!-- /container -->';
		}
		echo $body;
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	</body>
</html>
