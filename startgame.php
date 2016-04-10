<?php
include "base.php";

$id = $_GET["id"];
$game_type = $_GET["game_type"];
$data = mysqli_query($mysqli, "SELECT * FROM data WHERE game_id=" . $id);

$stringified = "";
$start = 1;
while($row = mysqli_fetch_array($data))
{
	if($start == 1)
	{
		$start = 0;
		$stringified .= $row['string_a'] . "_" . $row['string_b'];
	}
	else
	{
		$stringified .= "|" . $row['string_a'] . "_" . $row['string_b'];
	}
}

echo("<script>");
echo("localStorage.setItem('Revise','" . $stringified . "');");
echo("</script>");
echo('<meta http-equiv="refresh" content="0;game/' . $game_type . '">');
?>