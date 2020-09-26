<?php
require "header.php";
?>

<div class="container">   	
    <div class="col-xs-12 col-sm-12">			
		<?php
		$id = $_SESSION["id"];
		$hakusql = "SELECT * FROM tilaus where tilaaja_id = $id
		ORDER BY tilausnro DESC";
		$tulokset = $yhteys->query($hakusql);
		?>
		<div class="panel panel-default">
			<div class="panel-heading"><center><span class="glyphicon  glyphicon-cutlery"></span> Omat tilaukset </center></div>
			<ul class="list-group">
			<?php
			// jos tulosrivejä löytyi
			if ($tulokset->num_rows > 0) {
			while($rivi = $tulokset->fetch_assoc()) {				
			?>   
			<li class="list-group-item">											
			<strong><?php echo "Tilausnumero: ",$rivi["tilausnro"];?></strong>
			<span class="pull-right">Tilaus tehty: <?php echo date("d.m.Y H:i", strtotime($rivi["tilaus_saapunut_dt"]));?></span>
			<br>
			<span class="pull-right">Toimituksen päivämäärä: <?php echo date("d.m.Y ", strtotime($rivi["toimpaiva"]));?></span>
			<br>
			<form action="omantilauksentiedot.php" method="post">			
			<input type="submit" name="tilaaja_id" style="margin-right:5px" value="Tilauksen tiedot" class="btn btn-primary btn-xs">			
			<input type="hidden" name="tilaaja_id" value="<?php echo $rivi["tilaaja_id"]; ?>" />
			<input type="hidden" name="tilausnro" value="<?php echo $rivi["tilausnro"]; ?>" />
			</form>
			</li>
			<?php   }
			} else {
				echo "<br>";
				 ?><center>Ei tilauksia!</center><?php
				echo "<br>";
				
			}
			?>
			</ul>
		</div>			
	</div>
</div>

<?php
require "footer.php";
?>
	