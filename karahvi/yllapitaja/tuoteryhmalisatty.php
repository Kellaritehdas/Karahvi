<?php
require "headery.php";
?>
	
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"> </div>	
			<center>
			<div class="wrapper">
				<?php
				if(isset($_GET['success'])){
					echo '<p class="tuoteok">Tuoteryhma lisätty tietokantaan.</p>';
				}else {
				echo "Virhe: " . $lisayssql . "<br>" . $yhteys->error;
				}
				?>
				<br>
				<br>
				<form action="tuoteryhmanlisays.php">
				<input type="submit" value="Lisää uusi tuoteryhmä">
				</form>

			</div>
			</center>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	