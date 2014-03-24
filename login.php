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
		$status = '';
		if(isset($_COOKIE["id"]))
		{
			$body = 'cookie check success<br>Here we should redirect to the userpage.<br>';
		}
		if(isset($_COOKIE["wait"]))
		{
			$body =  "You have tried too many times to login. Please wait another " . floor(($_COOKIE["wait"]-time())/60)  . " minutes " . ($_COOKIE["wait"]-time())%60 . " seconds and try again.<br>";
		}
		if(!isset($_POST["attempts"]))
		{
			$attempts = 0;
		}
		else
		{
			$attempts = $_POST['attempts'] +1;
		}
		if(!isset($_POST["remember"]))
		{
			$remember = 'false';
		}
		else
		{
			$remember = $_POST["remember"];
		}
		if(!isset($_POST["email"]))
		{
			$email = "Email Address";
		}
		else
		{
			$email = $_POST["email"];
		}
		if(isset($_POST["password"]))
		{
			$password = $_POST["password"];
		}
		
		{
			include 'db.php';
			$result = mysqli_query($connection, "SELECT id, passhash , salt, activated FROM user WHERE email='$email'");

			while($row = mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$passhash = $row['passhash'];
				$salt = $row['salt'];
				$activated = $row['activated'];
			}
			
			if(mysqli_num_rows($result) > 0)
			{
				$testhash = crypt($password,$salt);
				
				if($passhash == $testhash)
				{
					if($activated == '0')
					{
						$body = 'login success<br>But it seems you havent verified your email yet. Please check and verify your email and then login.';
					}
					else
					{
						$body = 'login success<br>Here we should redirect to the userpage.<br>';
						if($remember == 'true')
						{
							setcookie("id", $id , false);
						}
					}
				}
			}
			else if($attempts < 10)
			{
				$status = "<font color='red' size='3'>Incorrect email\password combination.</font>";
			}
			else if($attempts >= 10)
			{
				$body = "You have tried too many times to login. Please wait 15 minutes and try again.";
				setcookie("wait", time()+60*15 ,time()+60*15);
			}
			else
			{
				$status = "<font color='red' size='3'>Email not found.</font>";
				$email = "Email address";
			}
		}

		if(!isset($body))
		{
		$body = '<div class="container">
				<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '" method = "post">
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
				<center><a href="forgot.php">Forgot Password?</a></center>
				<center>Dont have an account? Register <a href="register.php">here</a>.</center>

				</div> <!-- /container -->';
		}
		echo $body;
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	</body>
</html>
