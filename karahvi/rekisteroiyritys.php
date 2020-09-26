<?php
require "head.php";
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
        <h3>Yritys</h3>
		<p><a href="tietosuojaseloste.php">Lue tietosuojaseloste!</a></p>
        <p>Täytä kaavake huolellisesti.</p>
		
        <form action="inc/rekisteroiyrit.php" method="post">
            
			<label>Käyttäjätunnus</label><br> (Vain kirjaimia ja numeroita)<br>
			<input type="text" name="kayttajatunnus" pattern="[a-öA-Ö0-9]+" class="form-control" placeholder="Käyttäjätunnus" required value="<?php if(isset($_GET['kayttajatunnus'])){echo $_GET['kayttajatunnus'];}?>"><br>            			         
			<input type="hidden" name="kayttajaryhma_id" class="form-control" value="4">                            			
			<label>Yrityksen nimi</label>
			<input type="text" name="ytmsnimi" pattern="[a-öA-Ö0-9 @.-]+" class="form-control" placeholder="Yrityksen nimi" required value="<?php if(isset($_GET['ytmsnimi'])){echo $_GET['ytmsnimi'];}?>"> <br>           			
			<label>Y-tunnus</label>
			<input type="text" name="ytunnus" pattern="[0-9-]+" class="form-control" placeholder="Y-tunnus" required value="<?php if(isset($_GET['ytunnus'])){echo $_GET['ytunnus'];}?>"><br>       
			<label>Laskutusnumero</label>
			<input type="text" name="laskutusnro" pattern="[0-9]+" class="form-control" placeholder="Laskutusnumero" value="<?php if(isset($_GET['laskutusnro'])){echo $_GET['laskutusnro'];}?>"><br>            
			<label>Osoite</label>
			<input type="text" name="osoite" pattern="[a-öA-Ö0-9 -]+" class="form-control" placeholder="Osoite" required value="<?php if(isset($_GET['osoite'])){echo $_GET['osoite'];}?>"><br>           
			<label>Postinumero</label>
			<input type="text" name="postinumero" pattern="[0-9]+" class="form-control" placeholder="Postinumero" required value="<?php if(isset($_GET['postinumero'])){echo $_GET['postinumero'];}?>"> <br>           
			<label>Postitoimipaikka</label>
			<input type="text" name="postitoimipaikka" pattern="[a-öA-Ö0-9 -]+" class="form-control" placeholder="Postitoimipaikka" required value="<?php if(isset($_GET['postitoimipaikka'])){echo $_GET['postitoimipaikka'];}?>"> <br>           
			<label>Puhelinnumero</label>
			<input type="text" name="puhelinnumero" pattern="[0-9+]+" class="form-control" placeholder="Puhelinnumero" required value="<?php if(isset($_GET['puhelinnumero'])){echo $_GET['puhelinnumero'];}?>"> <br>          
			<label>Sähköpostiosoite</label>
			<input type="email" name="sahkopostiosoite" pattern="[a-zA-Z0-9@.-]+" class="form-control" placeholder="Sähköpostiosoite" required value="<?php if(isset($_GET['sahkoposti'])){echo $_GET['sahkoposti'];}?>">  <br>         
			<label>Yhteyshenkilön etunimi</label>
			<input type="text" name="yhthenketunimi" pattern="[a-öA-Ö -]+" class="form-control" placeholder="Yhteyshenkilön etunimi" required value="<?php if(isset($_GET['yhthenketunimi'])){echo $_GET['yhthenketunimi'];}?>"> <br>           
			<label>Yhteyshenkilön sukunimi</label>
			<input type="text" name="yhthenksukunimi" pattern="[a-öA-Ö -]+" class="form-control" placeholder="Yhteyshenkilön sukunimi" required value="<?php if(isset($_GET['yhthenksukunimi'])){echo $_GET['yhthenksukunimi'];}?>"><br>            
			<label>Salasana (Vähintään 6 merkkiä)</label>
			<input type="password" name="salasana" minlength="6" class="form-control" placeholder="Salasana" required> <br>        
			<label>Toista Salasana</label>
			<input type="password" name="confirm_salasana" minlength="6" class="form-control" placeholder="Toista salasana" required>  <br>         
			<input type="submit" class="btn btn-primary" name="submit-rek" value="Rekisteröidy">
			<input type="reset" class="btn btn-default" value="Tyhjennä">           
        </form>
</div>

<?php
require "foot.php";
?>