<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/default.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/red/style.css" type="text/css" media="print, projection, screen" />
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
		<script type="text/javascript">
			$(function() {		
				$("#tablesorter").tablesorter({sortList:[[0,1]], widgets: ['zebra']});
			});	
		</script>
        <title>PVP Stats</title>
    </head>
    <body>
		<?php 
		?>
		<div>
		<center>
		<table id="tablesorter" class="tablesorter">
		<thead>
			<tr>
				<th class="header headerSortUp"><strong>Points</strong></th>
				<td></td>
				<th class="header"><strong>Name</strong></th>
				<th class="header"><strong>Kills</strong></th>
				<th class="header"><strong>Deaths</strong></th>
				<th class="header"><strong>Ratio</strong></th>
			</tr>
		</thead>
		<tbody>
		<?php
		require("config/config.php");
		$top10 = mysql_query("SELECT * FROM pvpstats ORDER BY kills DESC");
		if(!$top10){
			echo "Error";
			die;
		}
		$mobTypes = array("Blaze", "Cave Spider", "Creeper", "Ghast", "Magma Cube", "Silverfish", "Skeleton", "Slime", "Spider", "Witch", "Zombie", "WitherSkeleton", "Zombie Pigman", "Wither", "Enderman", "Ender Dragon", "Wolf");
		while($player = mysql_fetch_assoc($top10)){
			$kills = $player['kills'];
			$deaths = $player['deaths'];
			$points = $kills - $deaths;
			if($deaths != 0){
				$kd = $kills / $deaths;
			} else {
				$kd = 0;
			}
			$output = "\n<tr><td>" . $points . "</td><td><img src=\"https://minotar.net/helm/".$player['name'].".png\" style=\"border-radius:3px;\" width=\"32\" height=\"32\"/></td><td><a href =\"player/".$player['name']." \"/>". $player['name']."</a></td><td>" . $player['kills'] . "</td><td>" . $player['deaths'] . "</td><td>" . round($kd, 2) . "</td></tr>\n";
			if(!isset($_GET['mob'])){
				$_GET['mob'] = "no";
			}
			if(in_array($player['name'], $mobTypes) && $_GET['mob'] == "yes"){
				echo "\n<tr><td>" . $points . "</td><td><img src=\"img/".$player['name'].".png\" style=\"border-radius:3px;\" width=\"32\" height=\"32\"/></td><td>" . $player['name'] . "</td><td>" . $player['kills'] . "</td><td>" . $player['deaths'] . "</td><td>" . round($kd, 2) . "</td></tr>\n";
			} elseif (!in_array($player['name'], $mobTypes) && $_GET['mob'] == "yes") {	
				echo $output;		
			} elseif (!in_array($player['name'], $mobTypes) && $_GET['mob'] == "no"){	
				echo $output;
			}	
		}
		

		?>
		</tbody>
		</table>
		<br>
		<?php if(!isset($_GET['mob']) || $_GET['mob'] == "no"){ ?>
		<a href="./?mob=yes">View with monster stats</a> 
		<?php } else { ?>
		<a href="./?mob=no">View without monster stats</a> 
		<?php } ?>
		<center>
		</div>
    </body>
</html>
