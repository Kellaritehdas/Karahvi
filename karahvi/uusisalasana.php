<?php
require "head.php";
?>
<div class="wrapper">
	
        <h2>Uusi salasana</h2>
        <p>Kirjoita sähköpostiosoite johon saat linkin salasanan uusimista varten.</p>
        <form action="inc/uusislsn.php" method="post"> 
        <input type="text" name="sahkopostiosoite" pattern="[a-zA-Z0-9@.-]+" class="form-control" placeholder="Kirjoita sähköpostiosoite">                            
		<br>				
        <input type="submit" name="uusisana" class="btn btn-primary btn-block" value="Lähetä salasanapyyntö">
				<br>
            <p>Ei ole tiliä? <a href="rekisterointi.php">Rekisteröidy tästä.</a></p>
        </form>
		<?php
		if(isset($_GET['reset'])){
			if($_GET['reset'] == "onnistui"){
				echo '<p class="rekok">Uuden salasanan pyyntö onnistui. Tarkista sähköpostisi!</p>';
			}
		}
		?>
</div>

 <?php
require "foot.php";
?>    