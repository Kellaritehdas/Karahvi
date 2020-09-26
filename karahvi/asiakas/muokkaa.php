<?php

require('../inc/config.php');

$id=$_REQUEST['id'];
$query = "SELECT * from kayttaja where id='".$id."'"; 
$result = mysqli_query($yhteys, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

require "header.php";
?>
	
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Päivitä tiedot </center></div>		
			<br>
			<div class="wrapper">

				<?php
				$status = "";
				if(isset($_POST['new']) && $_POST['new']==1)
				{
				$id=$_REQUEST['id'];

				$ytmsnimi = $_REQUEST['ytmsnimi'];
				$ytunnus = $_REQUEST['ytunnus'];
				$laskutusnro = $_REQUEST['laskutusnro'];
				$etunimi =$_REQUEST['etunimi'];
				$sukunimi = $_REQUEST['sukunimi'];
				$osoite = $_REQUEST['osoite'];
				$postinumero = $_REQUEST['postinumero'];
				$postitoimipaikka = $_REQUEST['postitoimipaikka'];
				$puhelinnumero = $_REQUEST['puhelinnumero'];
				$sahkopostiosoite =$_REQUEST['sahkopostiosoite'];
				$yhthenketunimi =$_REQUEST['yhthenketunimi'];
				$yhthenksukunimi = $_REQUEST['yhthenksukunimi'];
				$muokaika= date("Y-m-d h:i:sa");

				$update="update kayttaja set 
				ytmsnimi='".$ytmsnimi."',
				ytunnus='".$ytunnus."',
				laskutusnro='".$laskutusnro."',
				etunimi='".$etunimi."',
				sukunimi='".$sukunimi."',
				osoite='".$osoite."',
				postinumero='".$postinumero."',
				postitoimipaikka='".$postitoimipaikka."',
				puhelinnumero='".$puhelinnumero."', 
				sahkopostiosoite='".$sahkopostiosoite."',
				yhthenketunimi='".$yhthenketunimi."',
				yhthenksukunimi='".$yhthenksukunimi."',
				muokaika='".$muokaika."'
				where id='".$id."'";
				mysqli_query($yhteys, $update) or die(mysqli_error());
				$status = "Tiedot päivitetty. </br></br>
				<a href='omattiedot.php'>Takaisin omiin tietoihin</a>";
				echo '<p style="color:#FF0000;">'.$status.'</p>';
				}else {
				?>
				<div>
					<form name="form" method="post" action=""> 
					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

					<?php if(!empty($row["ytmsnimi"])){ ?>
					<label>Yrityksen nimi</label>
					<p><input type="text" class="form-control" name="ytmsnimi" placeholder="Yrityksen nimi" 
					required value="<?php echo $row['ytmsnimi'];?>" /></p><?php } 
					else { ?>
					<input name="ytmsnimi" type="hidden" value="" />
					<?php } ?>

					<?php if(!empty($row["ytunnus"])){ ?>
					<label>Y-tunnus</label>
					<p><input type="text" pattern="[0-9-]+" maxlength="9" size="9" class="form-control" name="ytunnus" placeholder="Y-tunnus" 
					required value="<?php echo $row['ytunnus'];?>" /></p><?php } 
					else { ?>
					<input name="ytunnus" type="hidden" value="" />
					<?php } ?>

					<?php if(!empty($row["laskutusnro"])){ ?>
					<label>Laskutusnumero</label>
					<p><input type="text" pattern="[0-9]+" class="form-control" name="laskutusnro" placeholder="Laskutusnumero" 
					required value="<?php echo $row['laskutusnro'];?>" /></p><?php } 
					else { ?>
					<input name="laskutusnro" type="hidden" value="" />
					<?php } ?>

					<?php if(!empty($row["etunimi"])){ ?>
					<label>Etunimi</label>
					<p><input type="text" pattern="[a-äA-Ä -]+" class="form-control" name="etunimi" placeholder="Etunimi" 
					required value="<?php echo $row['etunimi'];?>" /></p><?php }
					else { ?>
					<input name="etunimi" type="hidden" value="" />
					<?php } ?>

					<?php if(!empty($row["sukunimi"])){ ?>
					<label>Sukunimi</label>
					<p><input type="text" pattern="[a-äA-Ä -]+" class="form-control" name="sukunimi" placeholder="Sukunimi" 
					required value="<?php echo $row['sukunimi'];?>" /></p><?php } 
					else { ?>
					<input name="sukunimi" type="hidden" value="" />
					<?php } ?>

					<label>Osoite</label>
					<p><input type="text" pattern="[a-äA-Ä0-9 ]+" class="form-control" name="osoite" placeholder="Osoite" 
					required value="<?php echo $row['osoite'];?>" /></p>

					<label>Postinumero</label>
					<p><input type="text" pattern="[0-9]+" maxlength="5" size="5" class="form-control" name="postinumero" placeholder="Postinumero" 
					required value="<?php echo $row['postinumero'];?>" /></p>

					<label>Postitoimipaikka</label>
					<p><input type="text" pattern="[a-äA-Ä0-9 -]+" class="form-control" name="postitoimipaikka" placeholder="Postitoimipaikka" 
					required value="<?php echo $row['postitoimipaikka'];?>" /></p>

					<label>Puhelinnumero</label>
					<p><input type="text" pattern="[0-9+]+" class="form-control" name="puhelinnumero" placeholder="Puhelinnumero" 
					required value="<?php echo $row['puhelinnumero'];?>" /></p>

					<label>Sähkopostiosoite</label>
					<p><input type="email" pattern="[a-zA-Z0-9@.]+" class="form-control" name="sahkopostiosoite" placeholder="Sähkopostiosoite" 
					required value="<?php echo $row['sahkopostiosoite'];?>" /></p>

					<?php if(!empty($row["yhthenketunimi"])){ ?>
					<label>Yhteyshenkilön etunimi</label>
					<p><input type="text" pattern="[a-äA-Ä -]+" class="form-control" name="yhthenketunimi" placeholder="Yhteyshenkilön etunimi" 
					required value="<?php echo $row['yhthenketunimi'];?>" /></p><?php } 
					else { ?>
					<input name="yhthenketunimi" type="hidden" value="" />
					<?php } ?>

					<?php if(!empty($row["yhthenksukunimi"])){ ?>
					<label>Yhteyshenkilön sukunimi</label>
					<p><input type="text" pattern="[a-äA-Ä -]+" class="form-control" name="yhthenksukunimi" placeholder="Yhteyshenkilön sukunimi" 
					required value="<?php echo $row['yhthenksukunimi'];?>" /></p><?php } 
					else { ?>
					<input name="yhthenksukunimi" type="hidden" value="" />
					<?php } ?>

					<p><button class="btn btn-primary btn-sm" name="submit" type="submit" value="Update">PÄIVITÄ</button> 
					<button class="btn btn-default btn-sm"> <a href="omattiedot.php">PERUUTA</a></button></p>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>    
	</div>
</div>

<?php
require "footer.php";
?>