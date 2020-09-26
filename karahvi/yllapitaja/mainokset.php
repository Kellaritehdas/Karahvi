<?php
require "headery.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
		<?php 		
		$hakusql = "SELECT * FROM mainokset";
		$tulokset = $yhteys->query($hakusql);
		?>
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon  glyphicon-film"></span> Mainoskuvat </div>
				<br>						
				<br>
				<form action="mainoskuva.php" method="post">
				<input type="submit" name="submit" style="margin-left:15px" value="Lisää mainos" class="btn btn-success btn-xs">
				</form>
				<br>
				<center>
				<?php
					if(isset($_GET['success'])){
					echo '<p class="rekok">Mainoksen lisäys onnistui!</p>';
					}
					if(isset($_GET['poistettu'])){
					echo '<p class="rekvirhe">Mainos poistettu!</p>';
					}
				?>
				</center>
				<br>						
				<br>
				<ul class="list-group">
				<?php
				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {
					while($rivi = $tulokset->fetch_assoc()) {
				?>   
					<li class="list-group-item">		
					<strong><?php echo $rivi["kuva_nimi"];?></strong>
					<br><br>	
					<div id="mainos">
					<?php if(!empty($rivi["kuva_kuva"])){echo '<img src="../mainokset/'.$rivi["kuva_kuva"].'" height="200px"/>'.'<br>'.'<br>'; }?>
					</div>
					<form action="poistamainos.php" method="post">

					<input type="hidden" name="kuva_id" value="<?php echo $rivi["kuva_id"]; ?>" />
					<input type="submit" name="poista" value="Poista" class="btn btn-danger btn-xs" onclick="return confirm('HALUATKO VARMASTI POISTAA MAINOKSEN?')">

					</form>
					<br>					
					</li>
					<?php   }
					} else {
						echo "<br>";
						?><center>Ei Kuvia!</center><?php
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
