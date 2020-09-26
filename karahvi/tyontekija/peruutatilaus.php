<?php
require('../inc/config.php');
$tilausnumero=$_REQUEST['tilausnro'];
$paivays = date("Y-m-d H:i:s");
$tilausperuttu = "UPDATE tilaus SET tilaus_saapunut = '0', tilaus_peruttu = '1', tilaus_peruttu_dt = ('$paivays') WHERE tilausnro = ('$tilausnumero')";
$tulosok = $yhteys->query($tilausperuttu);
if ($tulosok === TRUE) {
		header("Location: tilausperuttu.php");
} else {
   echo "Virhe: " . $tilausperuttu . "<br>" . $yhteys->error;
   
}
?>