<?php
include "base.php";

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
?>
<meta http-equiv="refresh" content="0;dashboard">
<?php
}
else {
?>
<!DOCTYPE html>
<html>
	<title>
		Revise
	</title>
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</head>
	
	<body>
		<br/>
		<div id="main" class="container">
			<div class="row">
				<div class="col-md-8"></div>
				<div id="alert" class="alert alert-success fade in">
					<strong id="alertHeader"></strong> <span id="alertMessage"></span>
				</div>
				<div class="col-md-8"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<div id="loginBox">
						<form role="form" id="loginForm">
							<div class="form-group">
								<label for="username">Username:</label>
								<input id="loginUser" class="form-control" type="text" name="username" />
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input id="loginPassword"  class="form-control" type="password" name="password" />
							</div>
							<input id="loginButton" type="submit" class="btn btn-default" value="Login" />
						</form>
					</div>
				</div>

				<div class="col-md-4">
					<div id="registerBox">
						<form role="form" id="registerForm" role="form">
							<div class="form-group">
								<label for="username">Username:</label>
								<input id="registerUser" class="form-control" type="text" name="username" id="username" />
							</div>
							
							<div class="form-group">
								<label for="username">Email:</label>
								<input id="registerEmail" class="form-control" type="text" name="email" id="email" />
							</div>
							
							<div class="form-group">
								<label for="password">Password:</label>
								<input id="registerPass" class="form-control" type="password" name="password" id="password" />
							</div>
							
							<input id="registerButton" type="submit" class="btn btn-default" value="Register" />
						</form>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" id="searchbox"> 	
					<form role="form" method="POST" action="search.php" name="search" id="search">
						<label for="search_query">Search:</label><input class="form-control" type="text" name="search_query" id="search_query" /><br/>
						<div class="radio-inline">
							<label><input type="radio" name="search_type" value="name" checked="checked">Name</label>
						</div>
						<div class="radio-inline">
							<label><input type="radio" name="search_type" value="user" checked="checked">User</label>
						</div>
						<div class="radio-inline">
							<label><input type="radio" name="search_type" value="category" checked="checked">Category</label>
						</div>
						<input class="btn btn-default" type="submit" name="search" id="search" value="Search" />
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</body>
</html>
<?php	
}
?>
