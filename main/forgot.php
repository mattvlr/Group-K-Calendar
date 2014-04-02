<!DOCTYPE html>
<?php

$body = '';
$status = '';
$form = '';
if(isset($_GET['code']) )
{

	if(isset($_POST['change']) && isset($_POST['password']) && isset($_POST['password1']) )  //change password
	{
		if($_POST['password'] == $_POST['password1'])  //password are equal
		{
			$salt = uniqid(mt_rand(0,61),true);
			$passhash = crypt($_POST['password'],$salt);
			if($mysql->update('user',"passhash='" . $passhash . "' , salt='" . $salt . "' , forgot='0' ","forgot='". $_GET['code'] ."'"))
			{ 
				$status = '	<font color="green" size="5">Password Changed!<br></font>';
			}
			else
			{
				$status = 'Failed. Please reload and try again.';
			}
		
			$form = '<form class="form-signin">
			    <h2 class="form-signin-heading">Change Password:</h2>
				<h3>' . $status . '</font></h3>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="change" value = "true">';
		}
		else
		{
		$status = 'Passwords dont match';
		}
	
	}
	else if(strlen( $_GET['code']) == 13)   	//forgot password codes are 13 chars long
	{
		$code = $_GET['code'];
		if($mysql->exists('user', "forgot='".$code."'"))
		{
			echo "A";
			$form = '<form class="form-signin" role="form" action=?act=forgot&code='.$code.' method = "post">
			    <h2 class="form-signin-heading">Change Password:</h2>
				<h3>' . $status . '</font></h3>
				<input type="password" name = "password" id = "password" class="form-control" placeholder="Password" required autofocus>
				<input type="password" name = "password1" id = "password1" class="form-control" placeholder="Password" onkeyup="checkPass(); return false;" required>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="change" value = "true">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>';
		}
		else
		{
			echo "ACTIVATION CODE NOT FOUND";
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
	if(isset($_POST['email']))   //for initial password reset email
	{
		$status = "<font color ='red' size = 3>Email not found.</font>";
		if($mysql->exists('user',"email='" . $_POST['email'] ."'"))
		{
			$activation = crypt($_POST['email'],uniqid(mt_rand(0,61),true));
			if($mysql->update('user',"forgot='". $activation ."'",'email="' . $_POST['email'] . '"'))
			{ 
				require_once('smtp/Send_Mail.php');
				$activation_email = 'A request has been made to change your password.  If this was you click the link below to reset your password. Otherwise you may want to notify an Administrator.<br/><br/>
								<a href="'.$base_url.'/main/index.php?act=forgot&code='.$activation.'">'.$base_url.'/main/index.php?act=forgot&code='.$activation.'</a>';
				Send_Mail($_POST['email'],"Password Change",$activation_email);
				$status = '	<font color="green" size="5">Email Sent!<br></font>
						<font color="green" size="3">Check your email for an password change link.<br></font>';
			}
			else
			{
				$status = 'Failed. Please reload and try again.';
			}

			
		}
	}
	$form = '	<form class="form-signin" role="form" action=?act=forgot method = "post">
				<h2 class="form-signin-heading">Forgot Password?</h2>
				<h3>' . $status . '</font></h3>
				<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
				<a id = "confirmMessage"></a>
				<input type="hidden" name="forgot" value = "send">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Send Email</button>';
}

		$body = '<div class="forgot">
		'.$form.'
		</form>'; 

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
		<div="forgot">
			<?php echo $body;?>
		</div>
	</body>
</html>
