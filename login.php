<?php
include "base.php";

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5(mysqli_real_escape_string($mysqli, $_POST['password']));

$login = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'");
if(mysqli_num_rows($login) == 1)
{
	$row = mysqli_fetch_array($login);

	$_SESSION['Username'] = $username;
	$_SESSION['UserID'] = $row['id'];
	$_SESSION['EmailAddress'] = $row['email'];
	$_SESSION['LoggedIn'] = 1;
	
	echo('success');
}
else
{
	echo('incorrect');
}
?>