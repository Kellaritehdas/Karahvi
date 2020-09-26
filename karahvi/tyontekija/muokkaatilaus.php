<?php
require "headert.php";
require('../inc/config.php');
$tilausnro = $_POST["tilausnro"];
$tilaaja_id = $_POST['tilaaja_id'];
$query = "SELECT * from sisalto where tilausnro='".$tilausnro."'"; 
$result = mysqli_query($yhteys, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$hakusql = "SELECT * FROM tuote";
$tulokset = $yhteys->query($hakusql); 

?>

<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Päivitä tilaus </center></div>		
			<br>
				<div class="wrapper">
				<label>Tilausnumero</label>
				<p><?php echo $tilausnro;?></p>
				<strong>Tilauksen sisältö:</strong>
				<br><br>
					<?php 	
					$tuontisql = "SELECT * FROM sisalto where tilausnro = '".$tilausnro."'";
					$tulos = $yhteys->query($tuontisql);
					if ($tulos->num_rows > 0) {
						while($tieto = $tulos->fetch_assoc()) {
							$tuote = $tieto['tuote_id'];

							$nimisql = "SELECT * FROM tuote where tuote_id = ('$tuote')";
							$tulo = $yhteys->query($nimisql);
							$tuotetieto = $tulo->fetch_assoc();
							if($tieto["lukumaara"] >= 1){
								?>
								<form name="form" method="post" action="suoritamuokkaatilaus.php"><?php
								echo $tuotetieto['tuotenimi']." (".$tieto['sisaltonro'].")";?>
								<input type="number" class="form-control" name="lukumaara" 
								required value="<?php echo $tieto["lukumaara"];?>" />	
								<input type="hidden" name="sisaltonro" value="<?php echo $tieto['sisaltonro'];; ?>" />								
								<input type="hidden" name="tilausnro" value="<?php echo $tilausnro; ?>" />
								<input type="hidden" name="tilaaja_id" value="<?php echo $tilaaja_id; ?>" />
								<br>
								<button type="submit" name="paivitamaara" class='btn btn-primary btn-sm'>Muuta määrä</a></button>
								</form>
								<br>
								<form name="form" method="post" action="suoritapoistatuote.php">								
								<input type="hidden" name="sisaltonro" value="<?php echo $tieto['sisaltonro'];; ?>" />								
								<input type="hidden" name="tilausnro" value="<?php echo $tilausnro; ?>" />
								<input type="hidden" name="tilaaja_id" value="<?php echo $tilaaja_id; ?>" />								
								<button type="submit" name="poistatuote" class='btn btn-danger btn-sm' onclick="return confirm('HALUATKO VARMASTI POISTAA TUOTTEEN?')">Poista tuote</a></button>
								</form>
								<br>
								<?php
								}
							}
						}
						?>
						<form name="form" method="post" action="suoritalisaatilaukseen.php">
						<label>Hae lisättävä tuote: </label><br>
						
						<select class="form-control" name="tuote_id" required>
						<?php while($rivi = $tulokset->fetch_assoc()) { ?>   		
						<option value="<?php echo $rivi["tuote_id"]; ?>"><?php echo $rivi["tuotenimi"]. " (". $rivi["tuote_id"].")"." - á: ".number_format($rivi['hinta'],2)." €"; ?></option>
						<?php   } ?>
						</select><br>
						
						<label>Kappalemäärä: </label><br>
						<input type="number" class="form-control" name="lukumaara" required value="1" />	
						<br>
			
						<input type="hidden" name="tilausnro" value="<?php echo $tilausnro; ?>" />
						<input type="hidden" name="tilaaja_id" value="<?php echo $tilaaja_id; ?>" />						
						<button type="submit" name="paivitatilaus" class='btn btn-success btn-sm'>Lisää tuote</button>
						</form>
						<br>
						<form name="form" method="post" action="tilauksentiedot.php">
						<input type="hidden" name="tilausnro" value="<?php echo $tilausnro; ?>" />
						<input type="hidden" name="tilaaja_id" value="<?php echo $tilaaja_id; ?>" />
						<button type="submit" class="btn btn-default btn-sm">PERUUTA</button>
						</form>
			</div>
		</div>     
	</div>
</div>

<?php
require "footer.php";
?> 