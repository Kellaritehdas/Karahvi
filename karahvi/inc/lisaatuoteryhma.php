<?php
if(isset($_POST['tuoteryhmakantaan'])){
require 'config.php';
mysqli_set_charset($yhteys,"utf8");	

$ryhma_nimi = trim($_POST['ryhma_nimi']);
$kuvaus = trim($_POST['kuvaus']);

$lisayssql = "INSERT INTO tuoteryhma (ryhma_nimi, kuvaus) VALUES ('$ryhma_nimi', '$kuvaus')";
$tulos = $yhteys->query($lisayssql);

	if ($tulos === TRUE) {
		header("location: ../yllapitaja/tuoteryhmalisatty.php?success");
		exit();
	} 
	header("location: ../yllapitaja/tuoteryhmanlisays.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: ../yllapitaja/tuoteryhmanlisays.php?error=configeitoimi");
    exit();
}
?>
