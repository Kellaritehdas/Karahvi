<?php
require "headery.php";
?>
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Mainoskuva </center></div>	
				<div class="wrapper">
				<label>Lisää mainoskuva valitsemalla tiedostosta.</label><br>
				<label>Muista sovitut kuvakoot!</label><br>
				<br>
				<form action="../inc/suoritamainos.php" method="post" enctype="multipart/form-data">
				<label>Mainoksen kuva: </label><input type="file" name="image"><br>
				<label>Kuvan nimi tai otsikko: </label><input type="text" class="form-control" name="name"><br>
				<input type="submit" class="btn btn-primary" name="mainoskantaan" value="Lisää">
				<input type="reset" class="btn btn-default" value="Tyhjennä"></td></tr>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
require "footer.php";
?>