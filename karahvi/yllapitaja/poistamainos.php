<?php
require('../inc/config.php');
$id=$_REQUEST['kuva_id'];
$query = "DELETE FROM mainokset WHERE kuva_id=$id"; 
$result = mysqli_query($yhteys,$query) or die ( mysqli_error());
header("Location: mainokset.php?poistettu"); 
?>