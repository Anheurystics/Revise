<?php
include "base.php";

$username = mysql_real_escape_string($_POST['username']);
$password = md5(mysql_real_escape_string($_POST['password']));

$logincheck_query = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'";
$logincheck = mysql_query($logincheck_query) or die("error: " . mysql_error());
if(mysql_num_rows($logincheck) == 1)
{
	$row = mysql_fetch_array($logincheck);
	$email = $row['email'];
	
	$_SESSION['Username'] = $username;
	$_SESSION['UserID'] = $row['id'];
	$_SESSION['EmailAddress'] = $email;
	$_SESSION['LoggedIn'] = 1;
	
	echo('success');
}
else
{
	echo('incorrect');
}
?>