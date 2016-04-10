<?php
	include "..\base.php";
	
	
	if(empty($_SESSION['Username']))
	{
		echo('<meta http-equiv="refresh" content="0;..">');
		return;
	}
	
	$id = $_SESSION['UserID'];
	$username = $_SESSION['Username'];

	if(!empty($_POST['new_game']))
	{
		$game_name = mysqli_real_escape_string($mysqli, $_POST['game_name']);
		$game_desc = mysqli_real_escape_string($mysqli, $_POST['game_desc']);
		$game_category = mysqli_real_escape_string($mysqli, $_POST['category']);
		$game_type = mysqli_real_escape_string($mysqli, $_POST['game_type']);
		
		mysqli_query($mysqli, "INSERT INTO games (name, category, description, user_id, type) VALUES(
			'" . $game_name . "',
			'" . $game_category . "',
			'" . $game_desc . "',
			'" . $id . "',
			'" . $game_type . "')");
		
		$newgameid = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM games WHERE name = '" . $game_name . "'"))['id'];
		
		$num_data = $_POST['num_data'];
		if(strcmp($game_type, "ordering") != 0)
		{
			$num_data *= 2;
		}
		
		for($i = 0; $i < $num_data; $i++)
		{
			$newdata_query = "";
			if(strcmp($game_type, "ordering") == 0)
			{
				$a = $_POST["row" . $i];
				$newdata_query = "INSERT INTO data (game_id, string_a, string_b) VALUES('". $newgameid ."', '". $a ."', ' ')";
			}
			else 
			{
				$a = $_POST["row" . $i++];
				$b = $_POST["row" . $i];
				$newdata_query = "INSERT INTO data (game_id, string_a, string_b) VALUES('". $newgameid ."', '". $a ."', '". $b ."')";
			}
			
			mysqli_query($mysqli, $newdata_query);
		}
	}
	
	$games = mysqli_query($mysqli, "SELECT * FROM games WHERE user_id = " . $id);
	
	$gamelist = array();
	while($row = mysqli_fetch_array($games))
	{
		array_push($gamelist, $row);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard - <?php echo($username); ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>		
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<h1><?php echo("Hello, " . $username); ?></h1>
				</div>
				<div class="col-md-3">
					<a class="btn btn-info" href="../logout.php"><span style="font-size: 32px">Logout</span></a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" id="searchbox">
					<form role="form" method="POST" action="../search.php" name="search" id="search">
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
				<div class="col-md-2"></div>
			</div>
			<br/>			
			
			<div class="row">
				<div class="col-md-6">
					<h2>Create new reviewer</h2>
					<form role="form" method="POST" action="" name="new_game" id="new_game">
						<div class="form-group">
							<label for="game_name">Game Name:</label>
							<input class="form-control" type="text" name="game_name" id="game_name" />
						</div>
						
						<div class="form-group">
							<label for="game_type">Game Type:</label>
							<select class="form-control" oninput="updateRows()" name="game_type" id="game_type">
								<option value="matching">Matching Type</option>
								<option value="categories">Categories</option>
								<option value="ordering">Ordering</option>
							</select>
						</div>	
						<div class="form-group">
							<label for="category">Category:</label>
							<select class="form-control" name="category" id="category">
								<option value="history">History</option>
								<option value="math">Math</option>
								<option value="science">Science</option>
								<option value="english">English</option>
							</select>
						</div>
						<div class="form-group">
						<label for="game_data">Game Descripton:</label><br/><textarea class="form-control" name="game_desc" id="game_desc" rows="4" cols="50"></textarea><br/>
						</div>
						<label for="num_data">Number of rows:</label><input class="form-control" oninput="updateRows()" type="number" name="num_data" value="num_data" id="num_data" min="1"/><br/>
						<div id="data-rows" class="form-group">
						</div>
						<input class="btn btn-default" type="submit" name="new_game" id="new_game" value="Create Game" />
					</form>					
				</div>
				<div class="col-md-6">
					<h2>Your games (<?php echo(count($gamelist)); ?>)</h2>
					<div class="list-group">
					<?php
						foreach($gamelist as $game)
						{
							echo("<a href='../startgame.php?id=". $game["id"] . "&game_type=" . $game['type']  . "'><button type='button' class='list-group-item btn-block'>". $game["name"] ."</button></a>");
						}
					?>
					</div>

				</div>
				<div class="col=md-2"></div>	
			</div>
		</div>
	
		<script>
		function updateRows() {
			var n = parseInt(document.getElementById("num_data").value);
			
			var dataRows = document.getElementById("data-rows");
			var br = document.createElement("br");
			
			while (dataRows.hasChildNodes())
			{
				dataRows.removeChild(dataRows.lastChild);
			}
			
			if(document.getElementById("game_type").value != "ordering")
			{
				n *= 2;
			}
			
			for(var i = 0; i < parseInt(n) ; i++)
			{	
				var row = document.createElement("div");
				row.className = "row";
				
				var div1 = document.createElement("div");
				div1.className = "col-sm-12";
				
				var col1 = document.createElement("input");
				col1.className = "form-control";
				col1.id = i;
				col1.type = "text";
				col1.name = "row" + i;
				
				div1.appendChild(col1);
				row.appendChild(div1);
				
				if(document.getElementById("game_type").value != "ordering")
				{
					i++;
					var div2 = document.createElement("div");
					div2.className = "col-sm-6";
					
					var col2 = document.createElement("input");
					col2.className = "form-control";
					col2.id = i;
					col2.type = "text";
					col2.name = "row" + i;
					
					div1.className = "col-sm-6";
					
					div2.appendChild(col2);
					row.appendChild(div2);
				}
				
				dataRows.appendChild(row);
				dataRows.appendChild(document.createElement("br"));
			}
		}
		</script>		
	</body>
</html>