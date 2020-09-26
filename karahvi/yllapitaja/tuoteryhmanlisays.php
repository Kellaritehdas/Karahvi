<?php
require "headery.php";
?>

<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Tuoteryhmän lisääminen </center></div>	
			<div class="wrapper">
				<form action="../inc/lisaatuoteryhma.php" method="post">
				<label>Tuoteryhmän nimi: </label><input type="text" class="form-control" name="ryhma_nimi" required><br>
				<label>Kuvaus: </label><textarea class="form-control" name="kuvaus" required></textarea><br>
				<input type="submit" class="btn btn-primary" name="tuoteryhmakantaan" value="Lisää">
				<input type="reset" class="btn btn-default" value="Tyhjennä">
				</form>
			</div>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	
