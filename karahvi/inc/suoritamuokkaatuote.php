<?php
if(isset($_POST['paivitatuote'])){
require 'config.php';

$ryhma_id = $_POST['ryhma_id'];
$ryhma_nimi = $_POST['ryhma_nimi'];

$tuote_id = $_POST['tuote_id'];
$tuotenimi = trim($_POST['tuotenimi']);
$raakaaine = trim($_POST['raakaaine']);
$hinta = $_POST['hinta'];
$lisatiedot = trim($_POST['lisatiedot']);

$update="update tuote set 
tuotenimi='".$tuotenimi."',
raakaaine='".$raakaaine."',
hinta='".$hinta."',
lisatiedot='".$lisatiedot."'
where tuote_id='".$tuote_id."'";
$tulos = $yhteys->query($update);

	if ($tulos === TRUE) {
		//move_uploaded_file($_FILES['image']['tmp_name'], "../image/$kuva");
		header("location: ../yllapitaja/tuotteetsisallot.php?ryhma=$ryhma_id&ryhmanimi=$ryhma_nimi");
		exit();
	} 
	header("location: ../yllapitaja/muokkaatuote.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: ../yllapitaja/muokkaatuote.php?error=eitoimiei");
    exit();
}
?>
