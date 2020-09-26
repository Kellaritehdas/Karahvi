<?php
require "headery.php";
$tuotenimi=$_POST['tuotenimi'];
$tuote_id=$_POST['tuote_id'];
$ryhma_id = $_POST['ryhma_id'];
$ryhmanimi = $_POST['ryhmanimi'];
?>
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Tuotekuva </center></div>	
				<div class="wrapper">
				<label>Lisää tuotekuva valitsemalla tiedostosta.</label><br>
				<label>Poista tuotekuva jättämällä valinta tyhjäksi!</label><br>
				<br>
				<form action="../inc/suoritakuva.php" method="post" enctype="multipart/form-data">
				<label>Tuotteen kuva: </label><input type="file" name="image"><br>
				<label>Kuvan nimi: </label><input type="text" class="form-control" name="name"><br>
				<input type="hidden" name="ryhma_id" value="<?php echo $ryhma_id; ?>" />
				<input type="hidden" name="ryhmanimi" value="<?php echo $ryhmanimi; ?>" />
				<input type="hidden" name="tuote_id" value="<?php echo $tuote_id; ?>" />
				<input type="submit" class="btn btn-primary" name="kuvakantaan" value="Lisää">
				<input type="reset" class="btn btn-default" value="Tyhjennä"></td></tr>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
require "footer.php";
?>
	