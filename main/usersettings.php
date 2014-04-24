<?php

//GET USERS SETTINGS FROM DATABASE TO POPULATE FORM

	$user = $mysql->select('user', array('first_name','last_name','info','avatar'), "id = ".$id."");
		if($user['avatar'] != ''){$avatarlocation = $user['avatar'];}
		if($user['info'] != ''){$info = $user['info'];}
		$first = $user['first_name'];
		$last = $user['last_name'];

//GENERATE FORM

$form = '	
<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=settings" method = "post">
			<input type="text" name = "avatar" class="form-control" placeholder="'.$avatarlocation.'" required>
			<input type="text" name = "first" class="form-control" placeholder="'.$first.'" required>
			<input type="text" name = "last" class="form-control" placeholder="'.$last.'" required>
			<input type="password" name = "password" class="form-control" placeholder="Password" required>
			<input type="password1" name = "password1" class="form-control" placeholder="Password" required>

				<div class="form-group">
		  <label for="textArea" class="col-lg-2 control-label">About</label>
		  <div class="col-lg-10">
			<textarea class="form-control" rows="3" name="info" id="textArea" placeholder="'.$info.'"></textarea>
		  </div>	
			
			<input type="hidden" name="login" value = "true">
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Modify Settings</button>
		<br>
		</form>';
		
//AFTER FORM IS SUBMITTED
	if (isset($_POST['avatar']) && isset($_POST['first']) && isset($_POST['last']) && isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['info'])){
		$salt = uniqid(mt_rand(0,61),true);
		$passhash = crypt($_POST['password'],$salt);
		$mysql->update('user'  , 'avatar="'.$_POST['avatar'].'" , first_name="'.$_POST['first'].'" , last_name="'.$_POST['last'].'" , salt="'.$salt.'" , passhash="'.$passhash.'" , info="'.$_POST['info'].'"'  ,  'id="'.$id.'"');
	}

?>

<html>
<head>
<title>Settings</title>
	<?php 
		if($_SESSION['theme'] == 1){ 
			echo '<link href="/bootstrap/css/dark.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="dark_template.css">
			<link href="/bootstrap/css/dark_signin.css" rel="stylesheet">'; 
		}
		else { 
			echo '<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="template.css">
			<link href="/bootstrap/css/signin.css" rel="stylesheet">';
		} ?>
</head>
<body><center><h1>Settings</h1></center>
<?php
echo $form;
?>
</div></body></html>