<?php

if(isset($_POST['lasku'])){
require('../inc/config.php');
$paivays = date("Y-m-d H:i:s");
$erapaiva = date("d.m.Y", strtotime("+14 days"));
$tilausnro = $_POST['tilausnro'];
$sahkopostiosoite = $_POST['sahkopostiosoite'];



$lahlask = "UPDATE maksut SET lasklahaika = ('$paivays') WHERE tilausnro = ('$tilausnro')";
$tulosok = $yhteys->query($lahlask);
if ($tulosok === TRUE) {
		
		//SÄHKÖPOSTI Lasku asiakkaalle
		
		$email = $sahkopostiosoite;
		$subject = 'Karahvi - Lasku tilausnumerolle '.$tilausnro;
		$message = '<p>Laskunne tilaukselle: '.$tilausnro.'</p>';
		$message .= '<p>Tuotteet: </p></br></br>';
		
		$message .= '<table style="text-align:left">';
		$message .= '<tr><th>TUOTE</th><th>MÄÄRÄ</th><th>á HINTA</th></tr>';

		
		$tuontisql = "SELECT * FROM sisalto where tilausnro = ('$tilausnro')";
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
										$message .= "<tr><td>".$tuotetieto['tuotenimi']."</td><td>".$tieto["lukumaara"]." </td><td> ".number_format($kplhinta,2)." €</td></tr>";
										$kerto = $tieto["lukumaara"] * $tieto["ostohinta"];
										}
										$yhteensa += $kerto;
									}
								}
			$alv = $yhteensa * 0.14;
			$alvton = $yhteensa * 0.86;
			
		$message .= '</table>';
		$message .= '<table style="text-align:right">';
		$message .='<p><tr><th>Yhteensä: </th><th>'.number_format($yhteensa,2).' €</th></tr></p>';
		$message .='<p><tr><th>Alv: </th><th>'.number_format($alv,2).' €</th></tr></p>';
		$message .='<p><tr><th>Alvton: </th><th>'.number_format($alvton,2).' €</th></tr></p></br>';
		$message .= '</table>';
		$message .='<p>Tilinumero: FI00 0000 0000 0000 0000</p></br>';
		$message .='<p>Laittakaa viestikenttään tilausnumero: '.$tilausnro.'</p></br>';
		$message .='<p>Eräpäivä: '.$erapaiva.'</p></br>';
		$message .='<p>Kiitos. Terveisin keittiö!</p></br>';
		$headers ="From: Karahvi < Tässä laskunne >\r\n";
		$headers .="Content-type: text/html\r\n";
		
		header("Location:../inc/lasku.php?email=".$email."&subject=".$subject."&message=".$message);
		
} else {
   echo "Virhe: " . $lahlask . "<br>" . $yhteys->error;
}

}
?>