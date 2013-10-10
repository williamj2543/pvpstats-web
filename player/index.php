<?php
if (!isset($_GET['player'])) {
	header("location: ../");
} else {
	$player = mysql_real_escape_string($_GET['player']);
}
$skinURL = "http://minecraft.net/skin/" . $player . ".png";
if (!@fopen($skinURL, "r")) {
	header("location: ../");
}
require("../config/config.php");
?>
<link rel="stylesheet" href="../css/default.css" type="text/css" media="all" />
	<link href="../css/ui-darkness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="../js/jquery-1.9.1.js"></script>
	<script src="../js/jquery-ui-1.10.3.custom.js"></script>
	<script>
		 $(function() {
			$( document ).tooltip();
		});
	</script>
<div id="pname">
<h1>
	<?php
		echo $player;
	?>
</h1>
</div>
<br>
<div id="statscontainer">
	<a class="pic">
<?php 	echo "<img id=\"avatar\" src=\"https://minotar.net/helm/" . $player . ".png\"/>"; ?>
	</a>
		<div id="spacer"></div>
		<?php
		$query = mysql_fetch_assoc(mysql_query("SELECT * FROM pvpstats WHERE name = '" . $player . "'"));
		if(!$query){
			header("location: ../");
		} else {
			$kills = $query['kills'];
			$deaths = $query['deaths'];
			if($kills != 0 && $deaths != 0){
				$kd = round($kills/$deaths, 2);
			}
			$points = $kills - $deaths;
		}
		?>
		<div id="recentkills">
			<div style="float: left;">
			<?php
			$query2 = mysql_query("SELECT * FROM pvpstats_kill_log WHERE killer = '" . $player . "' ORDER BY stamp DESC LIMIT 16");
			if(!$query2){
				
			} else {
			while ($row = mysql_fetch_array($query2)) {
					echo "<a class=\"victim\" href=\"./" . $row['victim'] . "\" title=\" " . $row['victim'] . "\"><img id=\"victims\" src=\"https://minotar.net/helm/" . $row['victim'] . ".png\"/></a>";
				}
			}
			?>
			</div>
			<small style="clear:both;" class='recentkills'><?php echo (mysql_num_rows($query2) > 0)  ? $player . "'s recent kills" : $player . " has no recent kills."; ?></small>
		</div>
		<div id="spacer"></div>
		<div id="recentdeaths">
			<div style="float: left;">
			<?php
			$query3 = mysql_query("SELECT * FROM pvpstats_kill_log WHERE victim = '" . $player . "' ORDER BY stamp DESC LIMIT 16");
			if(!$query3){
				
			} else {
			$mobTypes = array("Blaze", "Cave Spider", "Creeper", "Ghast", "Magma Cube", "Silverfish", "Skeleton", "Slime", "Spider", "Witch", "Zombie", "WitherSkeleton", "Zombie Pigman", "Wither", "Enderman", "Ender Dragon", "Wolf");
			while ($row = mysql_fetch_array($query3)) {
				if (!in_array($row['killer'], $mobTypes)) {
					echo "<a class=\"victim\" href=\"./" . $row['killer'] . "\" title=\" " . $row['killer'] . "\"><img id=\"victims\" src=\"https://minotar.net/helm/" . $row['killer'] . ".png\"/></a>";
				} else {
					echo "<a class=\"victim\" href=\"#\" title=\" " . $row['killer'] . "\"><img id=\"victims\" src=\"../img/" . $row['killer'] . ".png\"/></a>";
				}
			}
			}
			?>
			</div>
			<small style="clear:both;" class='recentkills'><?php echo (mysql_num_rows($query3) > 0)  ? $player . "'s recent deaths" : $player . " has no recent deaths"; ?></small>
		</div>
	<div id="spacer"></div>
		<div id='statsright'>
		<h2 class='statsright'>
			<?php echo $kills; ?>
			<small class='statsright'>kills</small>
		</h2>
		<h2 class='statsright'>
			<?php echo $deaths; ?>
			<small class='statsright'>deaths</small>
		</h2>
		<h2 class='statsright'>
			<?php echo $kd; ?>
			<small class='statsright'>k/d</small>
		</h2>
		<h2 class='statsright'>
			<?php echo $points; ?>
			<small class='statsright'>points</small>
		</h2>
		</div>
	</div>
<center><a href='../'/>Back</a></center>


