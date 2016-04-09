<?php
include "base.php";

$username = mysql_real_escape_string($_POST['username']);
$password = md5(mysql_real_escape_string($_POST['password']));
$email = mysql_real_escape_string($_POST['email']);

$usercheck_query = "SELECT * FROM users WHERE username = '" . $username . "'";
$usercheck = mysql_query($usercheck_query);
if(mysql_num_rows($usercheck) == 1)
{
	echo("taken");
}
else
{
	$register_query = "INSERT INTO users (username, password, email) VALUES('" . $username . "', '" . $password . "', '" .$email."')";
	$register = mysql_query($register_query) or die(mysql_error());
	echo("success");
}
?>