<?php
session_start();
require('config.php');
mysqli_set_charset($yhteys,"utf8");

//tilausnumeron luominen

$kayttaja_id = $_SESSION['id'];
$sessiotunnus = session_id();
$lisayssql = "INSERT INTO tilausnumero (sessiotunnus, kayttaja_id, aktiivinen) VALUES ('$sessiotunnus', '$kayttaja_id', '0')";

$tulos = $yhteys->query($lisayssql);

if ($tulos === TRUE) {
	echo "Tilausnumero luotu"."<br>";
} else {
   echo "Virhe: " . $lisayssql . "<br>" . $yhteys->error;
}

//tilausnumero haku

$haetilausnro = "SELECT * FROM tilausnumero where sessiotunnus = ('$sessiotunnus') and aktiivinen = ('0')";
$tulokset = $yhteys->query($haetilausnro);

if ($tulokset->num_rows > 0) {

   while($rivi = $tulokset->fetch_assoc()) {

	$tilausnumero = $rivi["tilausnro"];
	echo "tilausnumero: ".$tilausnumero."<br>";
	}
	} else {
   echo "Ei tuloksia";
	} 

//tilauksen sisältö tietokantaan

$tuotteet = $_SESSION['ostokset'];
foreach($tuotteet as $rivi1 => $rivi2){
		
		$tuote_id = "$rivi2[tuote]";
		$lukumaara = "$rivi2[kplmaara]";
		$ostohinta = "$rivi2[yksikkohinta]";
		
		$lisayssql = "INSERT INTO sisalto (tilausnro, sessiotunnus, tuote_id, lukumaara, ostohinta) VALUES ('$tilausnumero', '$sessiotunnus', '$tuote_id', '$lukumaara', '$ostohinta')";

	$tulos = $yhteys->query($lisayssql);
}

if ($tulos === TRUE) {
		echo "Tilauksen sisältö lisätty tietokantaan"."<br>";
	unset($_SESSION['ostokset']);

} else {
   echo "Virhe: " . $lisayssql . "<br>" . $yhteys->error;
}
//tilauksen varmistus

$tilausok = "UPDATE tilausnumero SET aktiivinen = '1' WHERE tilausnro = ('$tilausnumero')";
$tulosok = $yhteys->query($tilausok);
if ($tulosok === TRUE) {
		echo "Tilausnumero varmennettu tietokantaan"."<br>";
	unset($_SESSION['ostokset']);

} else {
   echo "Virhe: " . $tilausok . "<br>" . $yhteys->error;
}

//tilauksen maksutapa tietokantaan

$maksutapa = $_POST['maksaminen'];
$maksut = "INSERT INTO maksut (tilausnro, maksutapa) VALUES ('$tilausnumero', '$maksutapa')";
$tulos = $yhteys->query($maksut);

if ($tulos === TRUE) {
	echo "Maksutapa rekisteröity"."<br>";
} else {
   echo "Virhe: " . $maksut . "<br>" . $yhteys->error;
}

//tilaustiedot tietokantaan


$toimpaiva = $_POST['alternate'];
$toimaika = $_POST['toimaika'];
$toimituspaikka = $_POST['toimituspaikka'];
$tilaaja_id = $_SESSION['id'];
$lisatiedot = $_POST['lisatiedot'];

$tilaukseen = "INSERT INTO tilaus(tilausnro, toimpaiva, toimaika, toimituspaikka, tilaaja_id, lisatiedot, tilaus_saapunut, tilaus_lahetetty, tilaus_peruttu) VALUES ('$tilausnumero', '$toimpaiva', '$toimaika', '$toimituspaikka', '$tilaaja_id', '$lisatiedot', '1', '0', '0')";

$tulos = $yhteys->query($tilaukseen);

if ($tulos === TRUE) {
	echo 'Tilaus tallenettu tietokantaan!'.'<br>';
	
	//SÄHKÖPOSTI Asiakkaalle tilauksesta, muokkaa tätä tarvittaessa
	
	$tilaaja = $_SESSION['id'];
	// echo 'Tilaajan ID: '.$tilaaja.'<br>';
	$haeemail = "SELECT * FROM kayttaja WHERE id = '$tilaaja'";
	$tulos = $yhteys -> query($haeemail);
	$haku = $tulos -> fetch_assoc();
	$sahkopostiosoite = $haku['sahkopostiosoite'];	
	
		$email = $sahkopostiosoite;
		$subject = 'Karahvi - Tilaus numerolla '.$tilausnumero;
		$message = '<p>Kiitos tilauksesta!</p></br>';
		$message .= '<p>Tilauksen toimitustapa: '.$toimituspaikka.'.</p>';
		$message .= '<p>Tilauksen sisältö:</p></br>';
		
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
		$message .='<p>Lisätiedot: '.$lisatiedot.'</p></br>';
		$message .='<p>Terveisin Karahvin tilausjärjestelmä!</p></br>';
		$headers ="From: Karahvi < Tilauksenne on rekisteröity >\r\n";
		$headers .="Content-type: text/html\r\n";
		
		
   header("Location:../inc/email.php?email=".$email."&subject=".$subject."&message=".$message);
} else {
   echo "Virhe: " . $tilaukseen . "<br>" . $yhteys->error;
}


$yhteys->close();

?>
