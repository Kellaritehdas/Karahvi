<?php 
if(isset($_POST['uusisana'])){
	
	$muuttuja = bin2hex(random_bytes(8));	
	$token = random_bytes(32);
	$merkki = bin2hex($token);
	$voimassa = date("U") + 1800;
	
	require 'config.php';
	
	$sahkopostiosoite = trim($_POST['sahkopostiosoite']);
	
	$sql = "DELETE FROM uusiss WHERE uusissEmail=?;";
	$stmt = mysqli_stmt_init($yhteys);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Virhe yhteydessä!";
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $sahkopostiosoite);
		mysqli_stmt_execute($stmt);
	}
	$sql = "INSERT INTO uusiss (uusissEmail, uusissMuuttuja, uusissToken, uusissVoimassa) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($yhteys);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Virhe yhteydessä!";
		exit();
	}
	else{
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $sahkopostiosoite, $muuttuja, $hashedToken, $voimassa);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($yhteys);
	
	$to = $sahkopostiosoite;
	
	header("Location: ../inc/sana.php?email=".$to."&muuttuja=".$muuttuja."&merkki=".$merkki);
	
	
}
else{
	header("location: ../index.php");
	exit();
}
?>