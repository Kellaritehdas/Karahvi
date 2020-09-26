
<?php
$palvelin = "localhost";
$kayttaja = "root";
$salasana = "";
$tietokanta = "karahvi";

$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
$yhteys->set_charset("utf8");
if ($yhteys->connect_error) {
   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
}
?>