<?php
require "headery.php";
?>

<div class="container"> 
	<center>
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Omat tiedot </center></div>	
			<br>
			<div id="tulokset">
				<?php
				$kayttajatunnus = ($_SESSION["kayttajatunnus"]);
				$hakusql = "SELECT * FROM kayttaja
				where kayttaja.kayttajatunnus = ('$kayttajatunnus')";
				$tulokset = $yhteys->query($hakusql);

				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {
				   // hae joka silmukan kierroksella uusi rivi
				   while($rivi = $tulokset->fetch_assoc()) {
					  // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
					  echo 
					  "<strong>Käyttäjätunnus: </strong>" . $rivi["kayttajatunnus"]. "<br>".
					  "<strong>Nimi: </strong>" . $rivi["etunimi"]. " ". $rivi["sukunimi"]."<br>".
					  "<strong>Osoite: </strong>" . $rivi["osoite"]. " ".$rivi["postinumero"]. " ".$rivi["postitoimipaikka"]. "<br>".
					  "<strong>Puhelinnumero: </strong>" . $rivi["puhelinnumero"]. "<br>".
					  "<strong>Sähköpostiosoite: </strong>" . $rivi["sahkopostiosoite"]."<br>". "<br>";
				   ?> <p><button1 class="btn btn-primary btn-sm"><a href="muokkaaomattiedotyllapitaja.php?id=<?php echo $rivi["id"]; ?>">MUOKKAA TIETOJA</a></button1><br><br> 
				   <button2 class="btn btn-default btn-sm"><a href="vaihdassyllapitaja.php?id=<?php echo $rivi["id"]; ?>">VAIHDA SALASANA</a></button2><br><br>
				   <button3 class='btn btn-danger btn-sm'><a href="poistatili.php?id=<?php echo $rivi["id"]; ?>" onclick="return confirm('HALUATKO VARMASTI POISTAA TILIN?')">POISTA TILISI</a></button3>
				   </p><?php 				
				   }
				} else {
				   echo "Ei tuloksia";
				}
				?>
			</div>
		</div>
	</div>	
	</center>
</div>
<?php
require "footer.php";
?>
	