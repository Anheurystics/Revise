<?php
include "base.php";

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5(mysqli_real_escape_string($mysqli, $_POST['password']));
$email = mysqli_real_escape_string($mysqli, $_POST['email']);

$exists = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '" . $email . "' OR username = '" . $username . "'");
if(mysqli_num_rows($exists) > 0)
{
	echo("taken");
}
else
{
	$register = mysqli_query($mysqli, "INSERT INTO users (username, password, email) VALUES('" . $username . "', '" . $password . "', '" .$email."')");
	echo("success");
}
?>