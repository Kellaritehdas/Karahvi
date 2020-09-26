<?php
require "headery.php";

		$hakusql = "SELECT * FROM tuoteryhma";
		$tulokset = $yhteys->query($hakusql);
?>

<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Tuotteen lisääminen </center></div>	
				<div class="wrapper">	
				<form action="../inc/lisaatuote.php" method="post" enctype="multipart/form-data">
				<label>Tuoteryhmä: </label><br>
				<select class="form-control" name="ryhma_id" required>
					<?php while($rivi = $tulokset->fetch_assoc()) { ?>   		
						<option value="<?php echo $rivi["ryhma_id"]; ?>"><?php echo $rivi["ryhma_nimi"]. " ". $rivi["ryhma_id"]; ?></option>
						<?php   } ?>
				</select><br>		
				
				<label>Tuotteen nimi: </label><input type="text" class="form-control" name="tuotenimi" required><br>´
				<label>Raaka-aineet: </label><textarea class="form-control" name="raakaaine" required></textarea><br>
				<label>Hinta: </label> <input type="number" placeholder="0.00" min="0.00 max="1000.00" class="form-control" name="hinta" step="0.01" value="0.00" required><br>
				<label>Lisätiedot: </label><textarea class="form-control" name="lisatiedot" cols="20" rows="2" ></textarea><br>
				<label>Tuotteen kuva: </label><input type="file" name="image"><br>
				<label>Kuvan nimi: </label><input type="text" class="form-control" name="name"><br>

				<input type="submit" class="btn btn-primary" name="tuotekantaan" value="Lisää">
				<input type="reset" class="btn btn-default" value="Tyhjennä"></td></tr>
				</form>
				<br>
			<?php
			if(isset($_GET['error'])){
				echo '<p>Jotain meni pieleen. Yritä uudelleen!</p>';
			}
			?>
			</div>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	
