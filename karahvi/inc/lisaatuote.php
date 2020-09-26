<?php
if(isset($_POST['tuotekantaan'])){
require 'config.php';
mysqli_set_charset($yhteys,"utf8");	

$ryhma_id = $_POST['ryhma_id'];
$tuotenimi = trim($_POST['tuotenimi']);
$raakaaine = trim($_POST['raakaaine']);
$hinta = $_POST['hinta'];
$lisatiedot = trim($_POST['lisatiedot']);
$kuva = $_FILES['image']['name'];
$kuvannimi = $_POST['name'];

$lisayssql = "INSERT INTO tuote (ryhma_id, tuotenimi, raakaaine, hinta, lisatiedot, kuva, kuvannimi) VALUES ('$ryhma_id', '$tuotenimi', '$raakaaine', '$hinta', '$lisatiedot', '$kuva', '$kuvannimi')";
$tulos = $yhteys->query($lisayssql);

	if ($tulos === TRUE) {
		move_uploaded_file($_FILES['image']['tmp_name'], "../image/$kuva");
		header("location: ../yllapitaja/tuotelisatty.php?success");
		exit();
	} 
	header("location: ../yllapitaja/tuotteenlisays.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: ../yllapitaja/tuotteenlisays.php?error=configeitoimi");
    exit();
}
?>
