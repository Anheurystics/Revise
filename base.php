<?php
include "/../sqlinfo.php";

session_start();

$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die(mysqli_error());
?>