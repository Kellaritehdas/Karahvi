<?php
require "headery.php";
?>
	
<div class="wrapper">
	<?php
	if(isset($_GET['error'])){
		if($_GET['error'] == "ympty"){
		echo '<p class="rekvirhe">Osa tiedoista puuttuu!</p>';
		}
		elseif($_GET['error'] == "kayttaja_ja_sahkoposti"){
		echo '<p class="rekvirhe">Käyttäjätunnus ja sähköposti virheellisissä muodoissa!</p>';
		}
		elseif($_GET['error'] == "kayttaja"){
		echo '<p class="rekvirhe">Käyttäjätunnus virheellisessä muodossa!</p>';
		}
		elseif($_GET['error'] == "sahkoposti"){
		echo '<p class="rekvirhe">Sähköpostiosoite virheellisessä muodossa!</p>';
		}
		elseif($_GET['error'] == "salasana"){
		echo '<p class="rekvirhe">Salasanat eivät täsmää!</p>';
		}
		elseif($_GET['error'] == "tkks"){
		echo '<p class="rekvirhe">Tietokantavirhe käyttäjätunnuksen tunnistuksessa!</p>';
		}
		elseif($_GET['error'] == "varattu"){
		echo '<p class="rekvirhe">Käyttäjätunnus varattu!</p>';
		}
		elseif($_GET['error'] == "tietosi"){
		echo '<p class="rekvirhe">Virhe tietokantayhteydessä! Yritä uudelleen!</p>';
		}
	}
	?>
	<h3>Henkilöasiakas</h3>
	<p>Täytä kaavake huolellisesti.</p>
	
	<form action="../inc/lisaahenki.php" method="post">            
		<label>Käyttäjätunnus</label><br> (Vain kirjaimia ja numeroita)<br>
		<input type="text" name="kayttajatunnus" pattern="[a-öA-Ö0-9]+" class="form-control" placeholder="Käyttäjätunnus" required value="<?php if(isset($_GET['kayttajatunnus'])){echo $_GET['kayttajatunnus'];}?>">  			             
		<input type="hidden" name="kayttajaryhma_id" class="form-control" value="1"><br>                			
		<label>Etunimi</label>
		<input type="text" name="etunimi" pattern="[a-öA-Ö -]+" class="form-control" placeholder="Etunimi" required value="<?php if(isset($_GET['etunimi'])){echo $_GET['etunimi'];}?>"><br>           			
		<label>Sukunimi</label>
		<input type="text" name="sukunimi" pattern="[a-öA-Ö -]+" class="form-control" placeholder="Sukunimi" required value="<?php if(isset($_GET['sukunimi'])){echo $_GET['sukunimi'];}?>"><br>            			
		<label>Osoite</label>
		<input type="text" name="osoite" pattern="[a-öA-Ö0-9 -]+" class="form-control" placeholder="Osoite" required value="<?php if(isset($_GET['osoite'])){echo $_GET['osoite'];}?>"><br>    
		<label>Postinumero</label>
		<input type="text" name="postinumero" pattern="[0-9]+"  maxlength="5" size="5" class="form-control" placeholder="Postinumero" required value="<?php if(isset($_GET['postinumero'])){echo $_GET['postinumero'];}?>"><br>        
		<label>Postitoimipaikka</label>
		<input type="text" name="postitoimipaikka" pattern="[a-öA-Ö0-9 -]+" class="form-control" placeholder="Postitoimipaikka" required value="<?php if(isset($_GET['postitoimipaikka'])){echo $_GET['postitoimipaikka'];}?>"><br>
		<label>Puhelinnumero</label>
		<input type="text" name="puhelinnumero" pattern="[0-9+]+" class="form-control" placeholder="Puhelinnumero" required value="<?php if(isset($_GET['puhelinnumero'])){echo $_GET['puhelinnumero'];}?>"><br>
		<label>Sähköpostiosoite</label>
		<input type="email" name="sahkopostiosoite" pattern="[a-zA-Z0-9@.-]+" class="form-control" placeholder="Sahkopostiosoite" required value="<?php if(isset($_GET['sahkopostiosoite'])){echo $_GET['sahkopostiosoite'];}?>"><br>
		<label>Salasana (Vähintään 6 merkkiä)</label>
		<input type="password" name="salasana" minlength="6" class="form-control" placeholder="Salasana" required><br>
		<label>Toista Salasana</label>
		<input type="password" name="confirm_salasana" minlength="6" class="form-control" placeholder="Toista salasana" required><br>
		
		<input type="submit" class="btn btn-primary" name="submit-rek" value="Rekisteröidy">
		<input type="reset" class="btn btn-default" value="Tyhjennä">
    </form>
</div>

<?php
require "footer.php";
?>