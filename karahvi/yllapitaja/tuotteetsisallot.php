<?php
require "headery.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
		<?php 
		$tuoteryhma = $_GET['ryhma'];
		$ryhmanimi = $_GET['ryhmanimi'];
		$kuvaus = $_GET['kuvaus'];
		
		$hakusql = "SELECT *, FORMAT(hinta,2) FROM tuote where tuote.ryhma_id = ('$tuoteryhma')";
		$tulokset = $yhteys->query($hakusql);
		?>
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> <?php echo $kuvaus; ?></div>
				<ul class="list-group">
				<?php
				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {
				while($rivi = $tulokset->fetch_assoc()) {
				?>   
				<li class="list-group-item">
					<strong><?php echo $rivi["tuotenimi"];?></strong>
					<span class="pull-right"><?php echo $rivi["FORMAT(hinta,2)"]." €";?></span><br><br>
					
					<form action="tuotekuva.php" method="post">
					<input type="hidden" name="tuote_id" value="<?php echo $rivi["tuote_id"]; ?>" />
					<input type="hidden" name="tuotenimi" value="<?php echo $rivi["tuotenimi"]; ?>" />
					<input type="hidden" name="ryhma_id" value="<?php echo $rivi["ryhma_id"]; ?>" />
					<input type="hidden" name="ryhmanimi" value="<?php echo $ryhmanimi; ?>" />
					<input type="submit" name="submit" style="margin-right:5px" value="Tuotekuva" class="btn btn-success btn-xs">
					</form>
					<br>
					<?php if(!empty($rivi["kuva"])){echo '<img src="../image/'.$rivi["kuva"].'" height="125px"/>'.'<br>'.'<br>'; }?>
					
					Tuotesisältö: <?php echo $rivi["raakaaine"];?><br>
					Lisätiedot: <?php echo $rivi["lisatiedot"];?><br>
					
					<form action="poistatuote.php" method="post">
					<span class="pull-right">
					<input type="hidden" name="tuote" value="<?php echo $rivi["tuote_id"]; ?>" />
					<input type="hidden" name="ryhma_id" value="<?php echo $rivi["ryhma_id"]; ?>" />
					<input type="submit" name="poista" value="Poista" class="btn btn-danger btn-xs" onclick="return confirm('HALUATKO VARMASTI POISTAA TILIN?')">
					</span>
					</form>						
					<form action="muokkaatuote.php" method="post">
					<span class="pull-right">
					<input type="submit" name="submit" style="margin-right:5px" value="Muokkaa" class="btn btn-primary btn-xs">
					</span><br>
					<input type="hidden" name="tuote_id" value="<?php echo $rivi["tuote_id"]; ?>" />
					<input type="hidden" name="ryhma_id" value="<?php echo $rivi["ryhma_id"]; ?>" />						
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
	