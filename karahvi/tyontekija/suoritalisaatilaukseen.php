
<?php
if(isset($_POST['paivitatilaus'])){
require '../inc/config.php';


$lukumaara = $_POST['lukumaara'];
$tuote_id = $_POST['tuote_id'];
$tilausnro = $_POST["tilausnro"];
$tilaaja_id = $_POST['tilaaja_id'];

$haehinta = "SELECT hinta FROM tuote where tuote_id = '$tuote_id'";
$tulos = $yhteys->query($haehinta);

if ($tulos->num_rows > 0) {
   while($rivi = $tulos->fetch_assoc()) {
	$ostohinta  = $rivi["hinta"];
	}
}
	

$insert="INSERT INTO sisalto (tilausnro, tuote_id, lukumaara, ostohinta) VALUES ('$tilausnro', '$tuote_id', '$lukumaara', '$ostohinta')";
$tulos = $yhteys->query($insert);

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
$yhteys->close();
?>