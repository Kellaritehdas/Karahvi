<?php
require "headery.php";
$id=$_REQUEST['id'];
$query = "SELECT * from kayttaja where id='".$id."'"; 
$result = mysqli_query($yhteys, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
	
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Päivitä tiedot </center></div>
			<br>
			<?php
			$status = "";
			if(isset($_POST['new']) && $_POST['new']==1)
			{
			$id=$_REQUEST['id'];

			//$ytmsnimi =$_REQUEST['ytmsnimi'];
			//$ytunnus = $_REQUEST['ytunnus'];
			$etunimi = $_REQUEST['etunimi'];
			$sukunimi = $_REQUEST['sukunimi'];
			$osoite = $_REQUEST['osoite'];
			$postinumero = $_REQUEST['postinumero'];
			$postitoimipaikka = $_REQUEST['postitoimipaikka'];
			$puhelinnumero = $_REQUEST['puhelinnumero'];
			$sahkopostiosoite =$_REQUEST['sahkopostiosoite'];
			$muokaika= date("Y-m-d h:i:sa");

			$update="update kayttaja set 
			etunimi='".$etunimi."',
			sukunimi='".$sukunimi."',
			osoite='".$osoite."',
			postinumero='".$postinumero."',
			postitoimipaikka='".$postitoimipaikka."',
			puhelinnumero='".$puhelinnumero."', 
			sahkopostiosoite='".$sahkopostiosoite."',
			muokaika='".$muokaika."' 
			where id='".$id."'";
			mysqli_query($yhteys, $update) or die(mysqli_error());
			$status = "Tiedot päivitetty. </br></br>
			<a href='yllapitajat.php'>Takaisin listaan</a>";
			echo '<p style="color:#FF0000;">'.$status.'</p>';
			}else {
			?>
			<div class="wrapper">
				<form name="form" method="post" action=""> 
				<input type="hidden" name="new" value="1" />
				<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
				<label>Käyttäjätunnus</label>
				<p><?php echo $row['kayttajatunnus'];?></p>
				<label>Etunimi</label>
				<p><input type="text" class="form-control" name="etunimi" placeholder="Etunimi" 
				required value="<?php echo $row['etunimi'];?>" /></p>
				<label>Sukunimi</label>
				<p><input type="text" class="form-control" name="sukunimi" placeholder="Sukunimi" 
				required value="<?php echo $row['sukunimi'];?>" /></p>
				<label>Osoite</label>
				<p><input type="text" class="form-control" name="osoite" placeholder="Osoite" 
				required value="<?php echo $row['osoite'];?>" /></p>
				<label>Postinumero</label>
				<p><input type="text" class="form-control" name="postinumero" placeholder="Postinumero" 
				required value="<?php echo $row['postinumero'];?>" /></p>
				<label>Postitoimipaikka</label>
				<p><input type="text" class="form-control" name="postitoimipaikka" placeholder="Postitoimipaikka" 
				required value="<?php echo $row['postitoimipaikka'];?>" /></p>
				<label>Puhelinnumero</label>
				<p><input type="text" class="form-control" name="puhelinnumero" placeholder="Puhelinnumero" 
				required value="<?php echo $row['puhelinnumero'];?>" /></p>
				<label>Sähköpostiosoite</label>
				<p><input type="email" class="form-control" name="sahkopostiosoite" placeholder="Sahkopostiosoite" 
				required value="<?php echo $row['sahkopostiosoite'];?>" /></p>

				<p><button class="btn btn-primary btn-sm" name="submit" type="submit" value="Update">PÄIVITÄ</button> 
				<button class="btn btn-default btn-sm"> <a href="yllapitajat.php">PERUUTA</a></button></p>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	