<?php 

$connection = mysqli_connect("localhost","calendar","groupk","calendar");  //Mysql information

if (mysqli_connect_errno()) {  //Check connection
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$username = $_POST['username'];
$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$DOB = $_POST['DOB'];

//queries to check to see if username and email already exists
$result = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
$result2 = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
//If it exists tell the user to use another name
if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0) { // The username and email provided are not already in use so create user row...
$salt = uniqid(mt_rand(0,61),true);
$passhash = crypt($_POST['password'],$salt);
echo $passhash;
$query = "INSERT INTO 'users' ( 'username', 'first_name', 'last_name', 'email', 'passhash', 'salt', 'DOB') VALUES ( '$username', '$first_name','$last_name','$email','$passhash','$salt', '$DOB');";
$result = mysqli_query($connection, $query);
if(!$result){  //System Fail
	echo 'Query Failed';
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
?>