<!DOCTYPE html>
<?php

$status = '';
if( isset($_POST["create"]) && isset($_POST['email']) && isset($_POST['password']))
{  
	$user_inuse = $mysql->exists('user',"username='".$_POST['username']."'");
	$email_inuse = $mysql->exists('user',"email='".$_POST['email']."'");
	if(!$user_inuse && !$email_inuse )
	{
	$salt = uniqid(mt_rand(0,61),true);
	$passhash = crypt($_POST['password'],$salt);
	$activation = crypt($_POST['email'],$salt);
	$userinfo = array(	'username' => $_POST['username'],
						'first_name' => $_POST['first_name'],
						'last_name' => $_POST['last_name'],
						'email' => $_POST['email'],
						'passhash' => $passhash,
						'salt' => $salt,
						'dob' => $_POST['dob'],
						'activation' => $activation,
						'theme' => 0
					);	
	if($mysql->insert('user',$userinfo))
	{
	//USER ADDED SUCCESSFULLY
		require_once('smtp/Send_Mail.php');
		$activation_email = 'Hello ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ', <br/> <br/> We need to confirm that this is your real email. To do so Click the link below.<br/><br/>
							<a href="'.$base_url.'/main/activate.php?code='.$activation.'">'.$base_url.'/main/activate.php?code='.$activation.'</a>';
		$status = '	<font color="green" size="5">Registration Successful<br></font>
					<font color="green" size="3">Check your email for an activation link!';
		Send_Mail($_POST['email'],"Email Verification",$activation_email);
		//header( 'Location: /index.php?act=onlogin' ) ;
	}
	
	}
	else if ( $user_inuse) {
		$status = '<font color="red" size="3">The username you have chosen is in use. Please use another one.';
	}
	else if ( $email_inuse) {
		$status = '<font color="red" size="3">The email you have chosen is in use. Please use another one.';
	}
	else
	{
		//$status = 'The email you have chosen is invalid.';
	}

}

$body = '<div class="register">
	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=register" method = "post">
	<h1>Welcome to Kalendar.</h1>
	<h2 class="form-signin-heading">Register:</h2>
	<h3>' . $status . '</font></h3>
	<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
	<input type="text" name = "username" class="form-control" placeholder="User Name" required>
	<input type="password" name = "password" id = "password" class="form-control" placeholder="Password" required>
	<input type="password" name = "password1" id = "password1" class="form-control" placeholder="Password" onkeyup="checkPass(); return false;" required>
	<a id = "confirmMessage"></a>
	<input type=text name = "first_name" class="form-control" placeholder="First Name" required>
	<input type=text name = "last_name" class="form-control" placeholder="Last Name" required>
	<center>Date of Birth :</center> <input type="date" name = "dob" class="form-control">
	<input type="hidden" name="create" value = "true">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
	<center> Already have an account? Login <a href="?act=login">here</a>.</center>

	</div> <!-- /register -->';

?>
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
		<div class="register">
			<?php echo $body;?>
		</div>
	</body>
</html>