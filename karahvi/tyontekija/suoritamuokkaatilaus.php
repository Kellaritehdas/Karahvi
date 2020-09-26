
<?php
if(isset($_POST['paivitamaara'])){
require '../inc/config.php';

$sisaltonro = $_POST['sisaltonro'];
$lukumaara = trim($_POST['lukumaara']);

$tilausnro = $_POST["tilausnro"];
$tilaaja_id = $_POST['tilaaja_id'];

$update="update sisalto set lukumaara='".$lukumaara."' where sisaltonro='".$sisaltonro."'";
$tulos = $yhteys->query($update);

	if ($tulos === TRUE) {
		header("location: tilauksentiedot.php?success&tilaaja_id=".$tilaaja_id."&tilausnro=".$tilausnro);
		exit();
	} 
	header("location: tilauksetavoimet.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: tilauksetavoimet.php?error=eitoimiei");
    exit();
	
}
?>
