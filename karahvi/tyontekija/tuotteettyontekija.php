<?php
require "headert.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
		<?php 
		$tuoteryhma = $_GET['ryhma'];
		$ryhmakuvaus = $_GET['ryhmakuvaus'];
		$hakusql = "SELECT *, FORMAT(hinta,2) FROM tuote where tuote.ryhma_id = ('$tuoteryhma')";
		$tulokset = $yhteys->query($hakusql);
		?>
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> <?php echo $ryhmakuvaus; ?></div>
				<ul class="list-group">
				<?php
				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {

				while($rivi = $tulokset->fetch_assoc()) {

				?>   
				<li class="list-group-item">			
					<strong><?php echo $rivi["tuotenimi"];?></strong>
					<span class="pull-right"><?php echo $rivi["FORMAT(hinta,2)"]." €";?></span><br><br>
					<?php if(!empty($rivi["kuva"])){echo '<img src="../image/'.$rivi["kuva"].'" height="125px"/>'.'<br>'.'<br>'; }?>
					Tuotesisältö: <?php echo $rivi["raakaaine"];?><br>
					Lisätiedot: <?php echo $rivi["lisatiedot"];?><br>
					
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