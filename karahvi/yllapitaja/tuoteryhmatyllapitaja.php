<?php
require "headery.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
		<?php		
		$hakusql = "SELECT * FROM tuoteryhma";
		$tulokset = $yhteys->query($hakusql);
		?>
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"> </span> TUOTERYHMÄT </div>
				<ul class="list-group">
				<?php
				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {
					while($rivi = $tulokset->fetch_assoc()) {
					?>   
					<li class="list-group-item">
					<strong><?php echo $rivi["ryhma_nimi"];?></strong>
					<br><br>
					<?php echo $rivi["kuvaus"];?>
					<br>
					
					
					<span class="pull-right">
					<input type="submit" name="poista" value="Poista" class="btn btn-danger btn-xs">
					</span>
					
					<form action="muokkaatuoteryhma.php" method="post">
					<span class="pull-right">
					<input type="submit" name="ryhma_id" style="margin-right:5px" value="Muokkaa" class="btn btn-primary btn-xs">
					</span><br>
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
	