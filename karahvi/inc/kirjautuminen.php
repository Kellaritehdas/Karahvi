<?php

if(isset($_SESSION["id"]) == true){
    header("location: ../inc/tarkistakayttajaryhma.php");
    exit;
}else{
	header("location: ../index.php");
    exit;
}
?>