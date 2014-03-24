<?php
include 'db.php';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$c=mysqli_query($connection,"SELECT id FROM user WHERE activation='$code'");

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($connection,"SELECT id FROM user WHERE activation='$code' and activated='0'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($connection,"UPDATE user SET activated='1' WHERE activation='$code'");
$msg="Your account is activated"; 
}
else
{
$msg ="Your account is already active, no need to activate again";
}

}
else
{
$msg ="Wrong activation code.";
}

}
?>
<?php echo $msg; ?>