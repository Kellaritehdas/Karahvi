<?php
require "headery.php";
?>

<div class="container">   		
    <center>
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"> Ylläpitäjät </div>						
			<br>
			<div id="tulokset">
				<?php
				$kayttajaryhma_id = "1";
				$hakusql = "SELECT * FROM kayttaja
				where kayttaja.kayttajaryhma_id = ('$kayttajaryhma_id') and kayttaja.aktiivinen = '1'
				order by sukunimi asc, etunimi";
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
				   ?> <p><button1 class="btn btn-primary btn-sm"><a href="muokkaayllapitajat.php?id=<?php echo $rivi["id"]; ?>">MUOKKAA</a></button1><br><br>
				   <button2 class="btn btn-default btn-sm"><a href="vaihdassyllapitajat.php?id=<?php echo $rivi["id"]; ?>">SALASANA</a></button2><br><br>
				   <button3 class='btn btn-danger btn-sm'><a href="poistatiliyllapitajat.php?id=<?php echo $rivi["id"]; ?>" onclick="return confirm('HALUATKO VARMASTI POISTAA TILIN KÄYTÖSTÄ?')">POISTA TILI</a></button3>
				   </p><?php 
					
				   }
				} else {
				   echo "<br>";
							?><center>Ei tuloksia!</center><?php
							echo "<br>";
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
	
