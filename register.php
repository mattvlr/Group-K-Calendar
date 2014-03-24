

<?php 
//TODO: input validation for forms, make neat like login page ...
if( $_POST["create"] == "true")
{
	include 'db.php';

	$username = $_POST['username'];  
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$DOB = $_POST['DOB'];

	//queries to check to see if username and email already exists
	$result = mysqli_query($connection, "SELECT * FROM user WHERE username='$username'");
	$result2 = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");

	//If it exists tell the user to use another name
	if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0) { // The username and email provided are not already in use so create user row
	$salt = uniqid(mt_rand(0,61),true);
	$passhash = crypt($_POST['password'],$salt);
	$query = "INSERT INTO user ( username, first_name, last_name, email, passhash, salt, DOB) VALUES ( '$username', '$first_name','$last_name','$email','$passhash','$salt', '$DOB');";
	$result = mysqli_query($connection, $query);
	if(!$result){  //System Fail
		echo 'Query Failed<br>';
		}
	if(mysqli_affected_rows($connection) == 1) {  //Registration Successful, user row successfully added
		echo 'Thanks for registering!';
	}
	else {
		echo 'You could not be registered due to an error, Please try again.';
	}
	}
	else if ( mysqli_num_rows($result) != 0) {
		echo 'The username you have chosen is in use. Please try another one.';
	}
	else if ( mysqli_num_rows($result2) != 0) {
		echo 'The email you have chosen is in use. Please try another one.';
	}
mysqli_close($con);
}
else
{
echo"
<html>
<body>

<form action='register.php' method='post'>
Username: <input type='text' name='username'><br>
Password: <input type='password' name='password'><br>
First Name: <input type='text' name='first_name'><br>
Last Name: <input type='text' name='last_name'><br>
E-mail: <input type='email' name='email'><br>
Birthday: <input type='date' name='DOB'>
<input type ='hidden' name = 'create' value = 'true'>
<input type='submit'>
</form>

</body>
</html>";
}

?>