<?php
require "headert.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">

		<?php

		$hakusql = "SELECT * FROM tilaus where tilaus_saapunut = 1 ORDER BY toimpaiva, toimaika";
		$tulokset = $yhteys->query($hakusql);
		?>
			<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> Avoimet tilaukset</div>
			<ul class="list-group">
		<?php
		// jos tulosrivejä löytyi
		if ($tulokset->num_rows > 0) {
		while($rivi = $tulokset->fetch_assoc()) {				
		?>   
		<li class="list-group-item">
					
						
						<strong><?php echo "Tilausnumero: ",$rivi["tilausnro"];?></strong>
						
						<span class="pull-right"><form action="tilauksentiedot.php" method="post">			
						<input type="submit" name="tilaaja_id" style="margin-right:5px" value="Tilauksen tiedot" class="btn btn-primary btn-xs">			
						<input type="hidden" name="tilaaja_id" value="<?php echo $rivi["tilaaja_id"]; ?>" />
						<input type="hidden" name="tilausnro" value="<?php echo $rivi["tilausnro"]; ?>" />
						</form></span>
						<br><br>
						<span class="pull-right">Tilaus saapunut: <?php echo date("d.m.Y H:i", strtotime($rivi["tilaus_saapunut_dt"]));?></span>
						<br>
						<span class="pull-right">Toimituksen päivämäärä: <?php echo date("d.m.Y ", strtotime($rivi["toimpaiva"]));?></span>
						<br>
						<span class="pull-right">Toimituksen kellonaika: <?php echo date("h.i ", strtotime($rivi["toimaika"]));?></span>
						<br>
						<?php $tilaus = $rivi["tilausnro"];?>
						<!-- Tilauksen sisältö:<br><br>
						<?php 	$tuontisql = "SELECT * FROM sisalto where tilausnro = ('$tilaus')";
								$tulos = $yhteys->query($tuontisql);
								if ($tulos->num_rows > 0) {
									while($tieto = $tulos->fetch_assoc()) {
										$tuote = $tieto['tuote_id'];
										$nimisql = "SELECT * FROM tuote where tuote_id = ('$tuote')";
										$tulo = $yhteys->query($nimisql);
										$tuotetieto = $tulo->fetch_assoc();
										
										echo $tuotetieto['tuotenimi']." - ".$tieto["lukumaara"]."<br>";
									}
								}
						?> -->
						<br>
						<strong>Lisätiedot: </strong><br>
						<?php echo $rivi["lisatiedot"];?><br>						
					
				</li>
		<?php   }
		} else {
			echo "<br>";
			?><center>Ei tuloksia!</center><?php
			echo "<br>";
		}
		?>
			</ul>
			</div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?> 