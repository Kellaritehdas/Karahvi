<?php
if(isset($_POST['poistatuote'])){
require '../inc/config.php';

$sisaltonro = $_POST['sisaltonro'];

$tilausnro = $_POST["tilausnro"];
$tilaaja_id = $_POST['tilaaja_id'];

$update = "DELETE FROM sisalto WHERE sisaltonro='$sisaltonro'"; 
$tulos = $yhteys->query($update);

	if ($tulos === TRUE) {
		header("location: tilauksentiedot.php?success&tilaaja_id=".$tilaaja_id."&tilausnro=".$tilausnro);
		exit();
	} 
	header("location: tilauksetavoimet.php?error=virhepoistossa");
    exit();
}
else{
	header("location: tilauksetavoimet.php?error=eitoimiei");
    exit();
	
}
?>