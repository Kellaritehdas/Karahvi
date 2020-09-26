<?php
if(isset($_POST['kuvakantaan'])){
require 'config.php';

$ryhma_id = $_POST['ryhma_id'];
$ryhmanimi = $_POST['ryhmanimi'];
$tuote_id = $_POST['tuote_id'];
$kuva = $_FILES['image']['name'];
$kuvannimi = $_POST['name'];


$update="update tuote set 
kuva='".$kuva."',
kuvannimi='".$kuvannimi."'
where tuote_id='".$tuote_id."'";
$tulos = $yhteys->query($update);

	if ($tulos === TRUE) {
		move_uploaded_file($_FILES['image']['tmp_name'], "../image/$kuva");
		header("location: ../yllapitaja/tuotteetsisallot.php?ryhma=$ryhma_id&ryhmanimi=$ryhmanimi");
		exit();
	} 
	header("location: ../yllapitaja/tuotekuva.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: ../yllapitaja/tuotekuva.php?error=eitoimiei");
    exit();
}
?>
