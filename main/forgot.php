<!DOCTYPE html>
<?php

$body = '';
$status = '';

if(isset($_GET['code']) )
{
	if(strlen( $_GET['code']) == 13)
	{
		$code = $_GET['code'];
		if($mysql->exists('user', 'activation', $code, ''))
		{
			echo "A";
			$form = '<h3>' . $status . '</font></h3>
				<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="forgot" value = "send">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>';
		}
		else
		{
			echo "B";
			$body = 'ACTIVATION CODE NOT FOUND';
		}
	}
	else
	{
		$body = 'Improper activation link format, try again.'; 
	}
}
else 
{
	if(isset($_POST['email']))
	{
		if($mysql->exists('email',$_POST['email']))
		{
			$status = "<font color ='green' size = 3>Check your email!</font>";
		}
		$status = "<font color ='red' size = 3>Email not found.</font>";
	}
	$form = '<h3>' . $status . '</font></h3>
				<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="forgot" value = "send">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Send Email</button>';
}

		$body = '<div class="container">
		<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '"?act=forgot method = "post">
		<h2 class="form-signin-heading">Forgot Password?</h2>
		'.$form.'
		</form>
		</div> <!-- /container --> SERVER_PHP_SELF: ' . $_SERVER['PHP_SELF'] . '?act=forgot'; 

?>

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
	echo $body;
?>
	</body>
</html>
