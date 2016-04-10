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
		<div id="main" class="container">
			<div class="row">
				<div class="col-sm-1"></div>
				<div id="alert" class="col-sm-10 alert alert-success fade in">
					<strong id="alertHeader"></strong> <span id="alertMessage"></span>
				</div>
				<div class="col-sm-1"></div>
			</div>
			
			<div class="row">
				<div class="col-sm-8">
					<div class="row" style="margin-bottom: 5vh;">
						<div class="col-sm-1"></div>
						<div class="col-sm-10"> 	
							<h1>Revise</h1>
							<h3>Play with interactive reviewers made by other people, covering different topics in school. Create your own and share them with others!</h3>
						</div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-10" id="searchbox"> 	
							<form role="form" method="POST" action="search.php" name="search" id="search">
								<input style="margin-bottom: 2vh;" class="form-control" placeholder="Search for reviewers made by other people..." type="text" name="search_query" id="search_query" />
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
						<div class="col-sm-1"></div>
					</div>					
				</div>
				
				<div class="col-sm-4">
					<div style="margin-top: 1vh; margin-bottom: 1vh;">
						<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" type="button" data-toggle="collapse" data-target="#login-register" aria-expanded="false" aria-controls="collapseExample">
							Log-in/Register
						</button>
					</div>
			
					<div id="login-register" class="collapse row" style="margin-bottom: 5vh;">
						<div class="col-sm-1"></div>
						<div class="col-sm-10">
							<ul class="nav nav-tabs" style="margin-bottom: 5vh;">
								<li class="active"><a data-toggle="tab" href="#login">Log-in</a></li>
								<li><a data-toggle="tab" href="#register">Register</a></li>
							</ul>
							
							<div class="tab-content">
								<div id="login" class="tab-pane active">
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

								<div id="register" class="tab-pane">
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
						</div>
						<div class="col-sm-1"></div>
					</div>
				</div>
			</div>		
		</div>
	</body>
</html>
<?php	
}
?>