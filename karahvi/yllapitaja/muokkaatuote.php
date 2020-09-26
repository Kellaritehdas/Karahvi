<?php
require "headery.php";
$tuote_id=$_POST['tuote_id'];
$query = "SELECT * from tuote inner join tuoteryhma on tuote.ryhma_id = tuoteryhma.ryhma_id where tuote_id='".$tuote_id."'"; 
$result = mysqli_query($yhteys, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Päivitä tiedot </center></div>	
			<div class="wrapper">
				<div>
					<form name="form" method="post" action="../inc/suoritamuokkaatuote.php"> 
					<input name="tuote_id" type="hidden" value="<?php echo $row['tuote_id'];?>" />
					<label>Tuoteryhmän numero</label>
					<p><?php echo $row['ryhma_id'];?></p>
					<label>Tuoteryhmän nimi</label>
					<p><?php echo $row['ryhma_nimi'];?></p>
					<label>Tuotenimi</label>
					<p><input type="text" class="form-control" name="tuotenimi" placeholder="Tuotenimi" 
					required value="<?php echo $row['tuotenimi'];?>" /></p>
					<label>Raaka-aineet</label>
					<p><textarea class="form-control" name="raakaaine" placeholder="Raaka-aineet" 
					/><?php echo $row['raakaaine'];?></textarea></p>
					<label>Hinta</label>
					<p><input type="text" class="form-control" name="hinta" placeholder="Hinta" 
					required value="<?php echo number_format($row['hinta'],2);?>" /></p>
					<label>Lisätiedot</label>
					<p><textarea class="form-control" name="lisatiedot" placeholder="Lisätiedot" 
					/><?php echo $row['lisatiedot'];?></textarea></p>

					<input type="hidden" name="ryhma_id" value="<?php echo $row["ryhma_id"]; ?>" />
					<input type="hidden" name="ryhma_nimi" value="<?php echo $row["ryhma_nimi"]; ?>" />
					<p><button class="btn btn-primary btn-sm" name="paivitatuote" type="submit" value="Update">PÄIVITÄ</button> 
					<button class="btn btn-default btn-sm"> <a href="tuotteetsisallot.php?ryhma=<?php echo $row['ryhma_id'];?>&ryhmanimi=<?php echo $row['ryhma_nimi'];?>" />PERUUTA</a></button></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	