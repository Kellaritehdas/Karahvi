<?php
require "header.php";
?>
	
<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Omat tiedot </center></div>	
			<center><br>
				<div id="tulokset">
					<?php
					$kayttajatunnus = ($_SESSION["kayttajatunnus"]);
					$hakusql = "SELECT * FROM kayttaja
					where kayttaja.kayttajatunnus = ('$kayttajatunnus')";
					$tulokset = $yhteys->query($hakusql);
					if ($tulokset->num_rows > 0) {  
						while($rivi = $tulokset->fetch_assoc()) {      
							if(!empty($rivi["kayttajatunnus"])){?><label>Käyttäjätunnus:</label><?php echo " " . $rivi["kayttajatunnus"]. "<br>". "<br>";}
							if(!empty($rivi["ytmsnimi"])){?><label>Yrityksen nimi:</label><?php echo " ".$rivi["ytmsnimi"]. "<br>". "<br>";}
							if(!empty($rivi["ytunnus"])){?><label>Y-tunnus:</label><?php echo " ".$rivi["ytunnus"]. "<br>". "<br>";}
							if(!empty($rivi["laskutusnro"])){?><label>Laskutusnumero:</label><?php echo " ".$rivi["laskutusnro"]. "<br>". "<br>";}
							if(!empty($rivi["etunimi"])){?><label>Nimi:</label><?php echo " ".$rivi["etunimi"]. " ";}
							if(!empty($rivi["sukunimi"])){echo $rivi["sukunimi"]. "<br>". "<br>";}
							if(!empty($rivi["yhthenketunimi"])){?><label>Yhteyshenkilö:</label><?php echo " ".$rivi["yhthenketunimi"]. " ";}
							if(!empty($rivi["yhthenksukunimi"])){echo $rivi["yhthenksukunimi"]. "<br>". "<br>";}
							if(!empty($rivi["osoite"])){?><label>Osoite:</label><?php echo " ".$rivi["osoite"]. " ";}
							if(!empty($rivi["postinumero"])){echo $rivi["postinumero"]. " ";}
							if(!empty($rivi["postitoimipaikka"])){echo $rivi["postitoimipaikka"]. "<br>". "<br>";}
							if(!empty($rivi["puhelinnumero"])){?><label>Puhelinnumero:</label><?php echo " ".$rivi["puhelinnumero"]. "<br>". "<br>";}
							if(!empty($rivi["sahkopostiosoite"])){?><label>Sähköpostiosoite:</label><?php echo " ".$rivi["sahkopostiosoite"]. "<br>". "<br>";}
							?><p>
							<button1 class="btn btn-primary btn-sm"><a href="muokkaa.php?id=<?php echo $rivi["id"]; ?>">MUOKKAA TIETOJA</a></button1><br><br> 
							<button2 class="btn btn-default btn-sm"><a href="vaihdass.php?id=<?php echo $rivi["id"]; ?>">VAIHDA SALASANA</a></button2><br><br>  
							<button3 class='btn btn-danger btn-sm'><a href="../inc/poistatili.php?id=<?php echo $rivi["id"]; ?>" onclick="return confirm('HALUATKO VARMASTI POISTAA TILIN KÄYTÖSTÄ?')">POISTA TILI</a></button3>
							</p><?php 
	
						}
					} else {
						echo "<br>";
						?><center>Ei tuloksia! Jotain on vialla. Ota yhteys Ninan Keittiöön!</center><?php
						echo "<br>";
					} ?>
			</div>
			<?php
			if(isset($_GET['success'])){
				echo '<p class="rekok">Salasanan vaihto onnistui!</p>';
			}
			if(isset($_GET['error'])){
				echo '<p class="rekok">Jotain meni pieleen!</p>';
			}
			?>			
		</center>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>