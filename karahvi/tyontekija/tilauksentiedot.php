<?php
require "headert.php";
?>
	
<div class="container">   
   <div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center><strong> Tilausnumero: <?php echo $_REQUEST['tilausnro']; ?> </strong>
			<button onclick="window.print()" class="btn btn-default btn-xs">Tulosta tilaus</button></center></div>
									
			<ul class="list-group">
			<div id="tulokset">
			<li class="list-group-item">
			<span class="pull-left">
			<strong>Tilaajan tiedot:</strong><br>
			<?php
			$tilaaja_id = $_REQUEST['tilaaja_id'];
			$hakusql = "SELECT * FROM kayttaja
			where id = ('$tilaaja_id')";
			$tulokset = $yhteys->query($hakusql);

			if ($tulokset->num_rows > 0) {
				while($rivi = $tulokset->fetch_assoc()) {	  
					if(!empty($rivi["ytmsnimi"])){echo $rivi["ytmsnimi"]. "<br>";}
					if(!empty($rivi["ytunnus"])){echo $rivi["ytunnus"]. "<br>";}
					if(!empty($rivi["etunimi"])){echo $rivi["etunimi"]. " ";}
					if(!empty($rivi["sukunimi"])){echo $rivi["sukunimi"]. "<br>";}
					if(!empty($rivi["yhthenketunimi"])){echo $rivi["yhthenketunimi"]. "";}
					if(!empty($rivi["yhthenksukunimi"])){echo $rivi["yhthenksukunimi"]. "<br>";}
					if(!empty($rivi["osoite"])){echo $rivi["osoite"]. " ";}
					if(!empty($rivi["postinumero"])){echo $rivi["postinumero"]. " ";}
					if(!empty($rivi["postitoimipaikka"])){echo $rivi["postitoimipaikka"]. "<br>";}
					if(!empty($rivi["puhelinnumero"])){echo $rivi["puhelinnumero"]. "<br>";}
					if(!empty($rivi["sahkopostiosoite"])){$sahkopostiosoite=$rivi["sahkopostiosoite"]; echo $sahkopostiosoite. "<br>"."<br>";}
					}
			} else {
				echo "<br>";
				?><center>Ei tuloksia!</center><?php
				echo "<br>";
			}
			?>
			</span>
			<!-- tilauksen sisältö alkaa -->
			<?php
			$tilausnum = $_POST['tilausnro'];
			$hakusql = "SELECT * FROM tilaus, maksut WHERE tilaus.tilausnro = $tilausnum AND maksut.tilausnro = $tilausnum";
			$tulokset = $yhteys->query($hakusql);
			if ($tulokset->num_rows > 0) {
			while($rivi = $tulokset->fetch_assoc()) {				
			?>   		
																	
						<span class="pull-right">Tilaus saapunut: <?php echo date("d.m.Y H:i", strtotime($rivi["tilaus_saapunut_dt"]));?></span>
						<br>
						<span class="pull-right">Toimituksen päivämäärä: <?php echo date("d.m.Y ", strtotime($rivi["toimpaiva"]));?></span>
						<br>
						<span class="pull-right">Toimituksen kellonaika: <?php echo date("H.i ", strtotime($rivi["toimaika"]));?></span>
						<br>
						<?php $toimitustapa = $rivi["toimituspaikka"]; ?> 
						<span class="pull-right">Toimitustapa: <?php echo $toimitustapa;?></span>
						<br>
						<span class="pull-right">Maksutapa: <?php 
						if($rivi['maksutapa'] == 0){echo 'lasku toimituksen jälkeen';}
						if($rivi['maksutapa'] == 1){echo 'maksetaan toimituksen yhteydessä';}
						if($rivi['maksutapa'] == 2){echo 'maksetaan noudon yhteydessä';}				
						?></span>
						
						
						<br><br>
						<br><br>
						
						<?php $tilaus = $rivi["tilausnro"];?>
						<br><br><br>
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
						
						<form action="peruutatilaus.php" method="post">						
						<span class="pull-right">						
						<input type="submit" name="tilausnro" value="Peru tilaus" class="btn btn-danger btn-xs" onclick="return confirm('HALUATKO VARMASTI PERUUTTAA TILAUKSEN?')">
						</span>
						<input type="hidden" name="tilausnro" value="<?php echo $rivi["tilausnro"]; ?>" />
						</form>
						<form action="valmistatilaus.php" method="post">
						<span class="pull-right">
						<input type="submit" name="tilausnro" style="margin-right:5px" value="Valmis" class="btn btn-success btn-xs" onclick="return confirm('ONKO TILAUS VARMASTI VALMIS?')">
						</span>
						<input type="hidden" name="tilausnro" value="<?php echo $rivi["tilausnro"]; ?>" />
						<input type="hidden" name="sahkopostiosoite" value="<?php echo $sahkopostiosoite; ?>" />
						<input type="hidden" name="toimitustapa" value="<?php echo $toimitustapa; ?>" />
						</form>
						<form action="muokkaatilaus.php" method="post">
						<span class="pull-right">
						<input type="submit" style="margin-right:5px" value="Muokkaa tilausta" class="btn btn-primary btn-xs" onclick="return confirm('HALUATKO VARMASTI MUUTTAA TILAUSTA?')">
						</span><br>
						<input type="hidden" name="tilaaja_id" value="<?php echo $tilaaja_id; ?>" />
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
	<!-- tilauksen sisältö loppuu -->				
</div>
<?php
require "footer.php";
?> 
