<?php
require('../inc/config.php');

$id=$_REQUEST['id'];
$lopetusaika = date("Y-m-d h:i:sa");
$query = "UPDATE kayttaja SET aktiivinen = '0', lopetusaika = '".$lopetusaika."' WHERE id='".$id."'";
$result = mysqli_query($yhteys,$query) or die ( mysqli_error());
header("Location: yritykset.php"); 
?>