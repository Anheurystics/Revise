<?php
include "base.php";

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5(mysqli_real_escape_string($mysqli, $_POST['password']));
$email = mysqli_real_escape_string($mysqli, $_POST['email']);

$user_exists = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '" . $username . "'");
if(mysqli_num_rows($user_exists) == 1)
{
	echo("taken");
}
else
{
	$register = mysqli_query($mysqli, "INSERT INTO users (username, password, email) VALUES('" . $username . "', '" . $password . "', '" .$email."')");
	echo("success");
}
?>