<?php
	include "base.php";
	
	$search_query = $_POST['search_query'];
	$search_type = $_POST['search_type'];
	$games = array();
	$back = "";
	
	$gamelist = null;
	if(strcmp($search_type, "name") == 0)
	{
		$gamelist = mysqli_query($mysqli, "SELECT * FROM games WHERE name LIKE '%" . $search_query . "%'");
	}
	elseif(strcmp($search_type, "user") == 0)
	{
		$users = mysqli_query($mysqli, "SELECT * FROM users WHERE username LIKE '%" . $search_query . "%'");
		if(mysqli_num_rows($users) > 0)
		{
			$ids = array();
			while($user = mysqli_fetch_array($users)) 
			{
				array_push($ids, $user["id"]);
			}
			$gamelist = mysqli_query($mysqli, "SELECT * FROM games WHERE user_id IN (" . implode(",", $ids) . ")");
		}
	}
	
	if($gamelist)
	{
		while($game = mysqli_fetch_array($gamelist))
		{
			$id = $game['id'];
			$user_id = $game['user_id'];
			$name = $game['name'];
			$type = $game['type'];

			$game['owner_name'] = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM users WHERE id='" . $user_id . "'"))['username'];
			
			array_push($games, $game);
		}
	}
	
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
	{
		$back = "dashboard";
	}
	else {
		$back = "index.php";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>		
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<h1><center>Results for "<?php echo($search_query); ?>"<center></h1>
				</div>
				<div class="col-md-1">
					<a class="btn btn-info" href=<?php echo($back); ?>><span style="font-size: 32px">Back</span></a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-10" id="searchbox"> 	
					<form role="form" method="POST" action="search.php" name="search" id="search">
						<input style="margin-bottom: 2vh;" class="form-control" placeholder="Search for reviewers made by other people..." type="text" name="search_query" id="search_query" />
						<input style="float: left;"class="btn btn-default" type="submit" name="search" id="search" value="Search" />
						<div class="form-inline" style="float: right;">
							<div class="radio-inline">
								<label><input type="radio" name="search_type" value="name" checked="checked">Name</label>
							</div>
							<div class="radio-inline">
								<label><input type="radio" name="search_type" value="user">User</label>
							</div>
							<div class="radio-inline">
								<label><input type="radio" name="search_type" value="category">Category</label>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-1"></div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<?php
					$count = count($games);
					echo("<h2>" . ($count > 0? $count : "No") . " search result" . ($count > 1? "s" : "") . " found.</h2>");
					
					foreach($games as $game)
					{
						echo("<div style='padding: 5% 2% 5% 2%'>");
						echo("<a href='startgame.php?id=". $game['id'] . "&game_type=" . $game['type']  . "'><button type='button' class='list-group-item btn-block'>". $game["name"] ."</button></a>");
						echo("<br/><span><strong>Creator: </strong>". $game['owner_name'] ."</span>");
						echo("<br/><span style='padding-top:10%;'><strong>Category: </strong>". $game['category'] ."</span>");
						echo("<br/><span><strong>Description: </strong>". $game['description'] ."</span>");
						echo("</div>");
					}
					?>
				</div>
				<div class="col-sm-1"></div>
			</div>			
		</div>
	</body>
</html>