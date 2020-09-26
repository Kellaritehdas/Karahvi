<?php
 
if(isset($_POST['submit-rek'])){
require 'config.php';	
mysqli_set_charset($yhteys,"utf8");	
	
	$kayttajaryhma_id = trim($_POST['kayttajaryhma_id']);
	$kayttajatunnus = trim($_POST['kayttajatunnus']);
	$etunimi = trim($_POST['etunimi']);
	$sukunimi = trim($_POST['sukunimi']);
	$osoite = trim($_POST['osoite']);
	$postinumero = trim($_POST['postinumero']);
	$postitoimipaikka = trim($_POST['postitoimipaikka']);
	$puhelinnumero = trim($_POST['puhelinnumero']);
	$sahkopostiosoite = trim($_POST['sahkopostiosoite']);
	$salasana = trim($_POST['salasana']);
	$confirm_salasana = trim($_POST['confirm_salasana']);
	
	if(empty($kayttajatunnus) || empty($etunimi) || empty($sukunimi) || empty($osoite) || empty($postinumero) || empty($postitoimipaikka) || empty($puhelinnumero) || empty($sahkopostiosoite)|| empty($salasana) || empty($confirm_salasana)){
		header("location: ../yllapitaja/lisaatyontekija.php?error=empty&kayttajatunnus=".$kayttajatunnus."&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite);
		exit();
	}
	elseif(!preg_match("/^[a-öA-Ö0-9@.-]*$/",$kayttajatunnus) && !filter_var($sahkopostiosoite, FILTER_VALIDATE_EMAIL)){
		header("location: ../yllapitaja/lisaatyontekija.php?error=kayttaja_ja_sahkoposti&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero);
		exit();
	}
	elseif(!preg_match("/^[a-öA-Ö0-9]*$/",$kayttajatunnus)){
		header("location: ../yllapitaja/lisaatyontekija.php?error=kayttaja&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite);
		exit();
	}
	elseif(!filter_var($sahkopostiosoite, FILTER_VALIDATE_EMAIL)){
		header("location: ../yllapitaja/lisaatyontekija.php?error=sahkoposti&kayttajatunnus=".$kayttajatunnus."&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero);
		exit();
	}
	elseif($salasana !== $confirm_salasana){
		header("location: ../yllapitaja/lisaatyontekija.php?error=salasana&kayttajatunnus=".$kayttajatunnus."&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite);
		exit();
	}
	else{

        $sql = "SELECT kayttajatunnus FROM kayttaja WHERE kayttajatunnus = ?";
        $stmt = mysqli_stmt_init($yhteys);
        if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../yllapitaja/lisaatyontekija.php?error=tkks&kayttajatunnus=".$kayttajatunnus."&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite);
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $kayttajatunnus);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$tarkistus = mysqli_stmt_num_rows($stmt);
				if($tarkistus > 0){
					header("location: ../yllapitaja/lisaatyontekija.php?error=varattu&etunimi=".$etunimi."&sukunimi=".$sukunimi."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite);
					exit();
                }
				else{
										
					$sql = "INSERT INTO kayttaja (kayttajaryhma_id, kayttajatunnus, etunimi, sukunimi, osoite, postinumero, postitoimipaikka, puhelinnumero, sahkopostiosoite, salasana) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($yhteys);
					if(!mysqli_stmt_prepare($stmt, $sql)){
					header("location: ../yllapitaja/lisaatyontekija.php?error=tietosi");
					exit();
					}
					else{
						$hashedSalasana = password_hash($salasana, PASSWORD_DEFAULT); 
						
						mysqli_stmt_bind_param($stmt, "ssssssssss", $kayttajaryhma_id, $kayttajatunnus, $etunimi, $sukunimi, $osoite, $postinumero, $postitoimipaikka, $puhelinnumero, $sahkopostiosoite, $hashedSalasana);
						mysqli_stmt_execute($stmt);
						header("location: ../yllapitaja/yllapitaja.php?rekisterointi=onnistunut");
					exit();
					}
				}
			}
			                        
    }
    
	mysqli_stmt_close($stmt);
    mysqli_close($yhteys);	
}
else {
	header("location: ../yllapitaja/yllapitaja.php");
    exit();
}
?>