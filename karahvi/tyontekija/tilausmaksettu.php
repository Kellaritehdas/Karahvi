<?php
require('../inc/config.php');
$tilausnumero=$_REQUEST['tilausnro'];
$paivays = date("Y-m-d H:i:s");
$tilausmaksettu = "UPDATE maksut SET maksettu = '1',maksettupvm = ('$paivays') WHERE tilausnro = ('$tilausnumero')";
$tulosok = $yhteys->query($tilausmaksettu);
if ($tulosok === TRUE) {
		header("Location: tilauksettoimitettu.php");
} else {
   echo "Virhe: " . $tilausmaksettu . "<br>" . $yhteys->error;
   
}
?>