<?php
require "header.php";
?>

<div class="container">   
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Tilausnumero: <?php echo $_REQUEST['tilausnro']; ?> </center></div>
			<ul class="list-group">
			<!-- tilauksen sisältö alkaa -->
				<div id="ts">
				<?php
				$tilausnum = $_REQUEST['tilausnro'];
				$hakusql = "SELECT * FROM tilaus, maksut WHERE tilaus.tilausnro = $tilausnum AND maksut.tilausnro = $tilausnum";
				$tulokset = $yhteys->query($hakusql);
				if ($tulokset->num_rows > 0) {
					while($rivi = $tulokset->fetch_assoc()) {				
				?>   		
				<span class="pull-right">Tilaus tehty: <?php echo date("d.m.Y H:i", strtotime($rivi["tilaus_saapunut_dt"]));?></span>
				<br>
				<span class="pull-right">Toimituksen päivämäärä: <?php echo date("d.m.Y ", strtotime($rivi["toimpaiva"]));?></span>
				<br>
				<span class="pull-right">Toimituksen kellonaika: <?php echo date("H.i ", strtotime($rivi["toimaika"]));?></span>
				<br>
				<span class="pull-right">Toimitustapa: <?php echo $rivi["toimituspaikka"];?></span>
				<br>
				<span class="pull-right">Maksutapa: <?php 
				if($rivi['maksutapa'] == 0){echo 'lasku toimituksen jälkeen';}
				if($rivi['maksutapa'] == 1){echo 'maksetaan toimituksen yhteydessä';}
				if($rivi['maksutapa'] == 2){echo 'maksetaan noudon yhteydessä';}				
				?></span>
				<br>
				<span class="pull-right">Maksettu: <?php 
				if($rivi['maksettu'] == 0 && (empty($rivi['lasklahaika']))){echo '<b style="color: red;">ei maksettu'.'</b>';}
				if($rivi['maksettu'] == 0 && (!empty($rivi['lasklahaika']))){echo '<b>lasku lähetetty'.'</b>';}
				if($rivi['maksettu'] == 1){echo '<b style="color: green;">maksettu '.date("d.m.Y H:i", strtotime($rivi['maksettupvm'])).'</b>';}								
				?></span>
				
				<?php $tilaus = $rivi["tilausnro"];?>
				<br>
				<strong>Tilauksen sisältö:</strong>
				<br><br>
				<?php 	$tuontisql = "SELECT * FROM sisalto where tilausnro = ('$tilaus')";
				$tulos = $yhteys->query($tuontisql);
				if ($tulos->num_rows > 0) {
					$yhteensa = 0;
					while($tieto = $tulos->fetch_assoc()) {
					$tuote = $tieto['tuote_id'];
					$nimisql = "SELECT * FROM tuote where tuote_id = ('$tuote')";
					$tulo = $yhteys->query($nimisql);
					$tuotetieto = $tulo->fetch_assoc();
					
					if($tieto["lukumaara"] >= 1){
						$kplhinta = $tieto["ostohinta"];
						echo $tuotetieto['tuotenimi']." - ".$tieto["lukumaara"]." kpl"." á ".number_format($kplhinta,2)." €"."<br>";
						$kerto = $tieto["lukumaara"] * $tieto["ostohinta"];
						}
						$yhteensa += $kerto;
					}
					
				}
				?>
				
				<span class="pull-right">						
				<span class="pull-right">Yhteensä: <?php echo number_format($yhteensa,2)." €";?></span>
				<br>
				<span class="pull-right">Alv. 14%: <?php $alv = $yhteensa * 0.14; echo number_format($alv,2)." €";?></span>
				<br>
				<span class="pull-right">Alvton: <?php $alvton = $yhteensa * 0.86; echo number_format($alvton,2)." €";?></span>
				<br>
				</span>
				<br><br><br>
				<strong>Lisätiedot:</strong><br>
				<?php echo $rivi["lisatiedot"];?><br>																
				<?php   }
				} else {
				echo "<br>";
					?><div id="ts">Ei tilauksia!</div><?php
					echo "<br>";
				}
				?>
			</ul>
			</div>
        </div>
		</ul>
	</div>	
</div>

<?php
require "footer.php";
?>
	