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
					echo '<p class="tuoteok">Tuote lisätty tietokantaan.</p>';
				}else {
				echo "Virhe: " . $lisayssql . "<br>" . $yhteys->error;
				}
				?>
				<br>
				<br>
				<form action="tuotteenlisays.php">
				<input type="submit" value="Lisää uusi tuote">
				</form>

			</div>
			</center>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	