<?php
require('../inc/config.php');
$tilausnumero= $_REQUEST['tilausnro'];
$sahkopostiosoite = trim($_POST['sahkopostiosoite']);
$toimitustapa = $_POST['toimitustapa'];
$paivays = date("Y-m-d H:i:s");

$tilausvalmis = "UPDATE tilaus SET tilaus_saapunut = '0', tilaus_lahetetty = '1', tilaus_lahetetty_dt = ('$paivays') WHERE tilausnro = ('$tilausnumero')";
$tulosok = $yhteys->query($tilausvalmis);
if ($tulosok === TRUE) {
	
		//SÄHKÖPOSTI Asiakkaalle valmiista tilauksesta
		
		$email = $sahkopostiosoite;
		$subject = 'Tilaus numerolla '.$tilausnumero.' on valmis';
		$message = '<p>Tilauksenne on valmistunut!</p>';
		$message .= '<p>Tilauksen toimitustapa: '.$toimitustapa.'.</p></br></br>';
		
		$tuontisql = "SELECT * FROM sisalto where tilausnro = ('$tilausnumero')";
								$tulos = $yhteys->query($tuontisql);
								if ($tulos->num_rows > 0) {
									$yhteensa = 0;
									while($tieto = $tulos->fetch_assoc()) {
										$tuote = $tieto['tuote_id'];
										$nimisql = "SELECT * FROM tuote where tuote_id = ('$tuote')";
										$tulo = $yhteys->query($nimisql);
										$tuotetieto = $tulo->fetch_assoc();
										if($tieto["lukumaara"] >= 1){
										$kplhinta = $tieto["ostohinta"];
										$message .= $tuotetieto['tuotenimi']." - ".$tieto["lukumaara"]." kpl"." á ".number_format($kplhinta,2)." €"."<br>";
										$kerto = $tieto["lukumaara"] * $tieto["ostohinta"];
										}
										$yhteensa += $kerto;
									}
								}
			$alv = $yhteensa * 0.14;
			$alvton = $yhteensa * 0.86;
		$message .='<p>Yhteensä: '.number_format($yhteensa,2).' €</p>';
		$message .='<p>Alv: '.number_format($alv,2).' €</p>';
		$message .='<p>Alvton: '.number_format($alvton,2).' €</p></br>';
		$message .='<p>Terveisin keittiö!</p></br>';
		$headers ="From: Karahvi < Tilaus valmistunut >\r\n";
		$headers .="Content-type: text/html\r\n";

		
		header("Location:../inc/valmis.php?email=".$email."&subject=".$subject."&message=".$message);
} else {
   echo "Virhe: " . $tilausvalmis . "<br>" . $yhteys->error;
}




?>