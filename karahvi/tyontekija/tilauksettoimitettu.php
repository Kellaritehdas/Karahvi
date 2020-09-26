<?php
require "headert.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">

		<?php

		$hakusql = "SELECT * FROM tilaus where tilaus_lahetetty = 1 ORDER BY tilausnro DESC";
		$tulokset = $yhteys->query($hakusql);
		?>
			<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> Toimitetut tilaukset</div>
			<ul class="list-group">
		<?php
		// jos tulosrivejä löytyi
		if ($tulokset->num_rows > 0) {
		while($rivi = $tulokset->fetch_assoc()) {				
		?>   
		<li class="list-group-item">					
						
						<strong><?php $tilausnro = $rivi["tilausnro"]; echo "Tilausnumero: ",$tilausnro;?></strong>
						<span class="pull-right">Tilaus saapunut: <?php echo date("d.m.Y H:i", strtotime($rivi["tilaus_saapunut_dt"]));?></span>
						<br>
						<span class="pull-right">Toimituksen päivämäärä: <?php echo date("d.m.Y", strtotime($rivi["toimpaiva"]));?></span>
						<br>
						
						<span class="pull-right">Maksettu: <?php 
						$haemaksu = "SELECT * FROM maksut WHERE tilausnro = '$tilausnro'";
						$tulos = $yhteys -> query($haemaksu);
						$haku = $tulos -> fetch_assoc();						
						if($haku['maksettu'] == 0 && (empty($haku['lasklahaika']))){echo '<b style="color: red;">ei maksettu</b>';}
						if($haku['maksettu'] == 0 && (!empty($haku['lasklahaika']))) {echo '<b>lasku lähetetty '.date("d.m.Y H:i", strtotime($haku['lasklahaika'])).'</b><br>';}
						if($haku['maksettu'] == 1){echo '<b style="color: green;">maksettu '.date("d.m.Y H:i", strtotime($haku['maksettupvm'])).'</b>';}								
						?></span>
						<br>
						<form action="toimitettutilaus.php" method="post">			
						<input type="submit" name="tilaaja_id" style="margin-right:5px" value="Tilauksen tiedot" class="btn btn-primary btn-xs">			
						<input type="hidden" name="tilaaja_id" value="<?php echo $rivi["tilaaja_id"]; ?>" />
						<input type="hidden" name="tilausnro" value="<?php echo $rivi["tilausnro"]; ?>" />
						</form>																							
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
