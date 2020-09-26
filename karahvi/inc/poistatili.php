<?php

require 'config.php';
$id=$_GET['id'];
$lopetusaika = date("Y-m-d h:i:sa");
$query = "UPDATE kayttaja SET aktiivinen = '0', lopetusaika = '".$lopetusaika."' WHERE id= '".$id."'"; 
$result = mysqli_query($yhteys,$query) or die ( mysqli_error());
header("Location: logout.php");
exit();
?>