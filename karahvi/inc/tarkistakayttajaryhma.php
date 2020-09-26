<?php
		if($_SESSION["kayttajaryhma_id"] == 1){header("location: ../yllapitaja/yllapitaja.php");}
		if($_SESSION["kayttajaryhma_id"] == 2){header("location: ../tyontekija/tyontekija.php");}
		if($_SESSION["kayttajaryhma_id"] == 3){header("location: ../asiakas/kirjautunut.php");}
		if($_SESSION["kayttajaryhma_id"] == 4){header("location: ../asiakas/kirjautunut.php");}
exit();
?>