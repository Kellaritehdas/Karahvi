<?php
require('../inc/config.php');
$id=$_REQUEST['tuote'];
$ryhma=$_POST['ryhma_id'];
$query = "DELETE FROM tuote WHERE tuote_id=$id"; 
$result = mysqli_query($yhteys,$query) or die ( mysqli_error());
header("Location: tuotteetsisallot.php?ryhma=$ryhma"); 
?>