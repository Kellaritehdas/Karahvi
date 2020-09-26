<?php
 
if(isset($_POST['submit-rek'])){
require 'config.php';
mysqli_set_charset($yhteys,"utf8");		
	
	$kayttajaryhma_id = trim($_POST['kayttajaryhma_id']);
	$kayttajatunnus = trim($_POST['kayttajatunnus']);
	$osoite = trim($_POST['osoite']);
	$postinumero = trim($_POST['postinumero']);
	$postitoimipaikka = trim($_POST['postitoimipaikka']);
	$puhelinnumero = trim($_POST['puhelinnumero']);
	$sahkopostiosoite = trim($_POST['sahkopostiosoite']);
	$ytmsnimi = trim($_POST['ytmsnimi']);
	$ytunnus = trim($_POST['ytunnus']);
	$laskutusnro = trim($_POST['laskutusnro']);
	$yhthenketunimi = trim($_POST['yhthenketunimi']);
	$yhthenksukunimi = trim($_POST['yhthenksukunimi']);
	$salasana = trim($_POST['salasana']);
	$confirm_salasana = trim($_POST['confirm_salasana']);
	
	if(empty($kayttajatunnus) || empty($osoite) || empty($postinumero) || empty($postitoimipaikka) || empty($puhelinnumero) || empty($sahkopostiosoite) || empty($ytmsnimi) || empty($ytunnus) || empty($yhthenketunimi) || empty($yhthenksukunimi) || empty($salasana) || empty($confirm_salasana)){
		header("location: ../rekisteroiyritys.php?error=empty&kayttajatunnus=".$kayttajatunnus."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
		exit();
	}
	elseif(!preg_match("/^a-öA-Ö0-9@.-]*$/",$kayttajatunnus) && !filter_var($sahkopostiosoite, FILTER_VALIDATE_EMAIL)){
		header("location: ../rekisteroiyritys.php?error=kayttaja_ja_sahkoposti&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
		exit();
	}
	elseif(!preg_match("/^[a-öA-Ö0-9]*$/",$kayttajatunnus)){
		header("location: ../rekisteroiyritys.php?error=kayttaja&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
		exit();
	}
	elseif(!filter_var($sahkopostiosoite, FILTER_VALIDATE_EMAIL)){
		header("location: ../rekisteroiyritys.php?error=sahkoposti&kayttajatunnus=".$kayttajatunnus."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
		exit();
	}
	elseif($salasana !== $confirm_salasana){
		header("location: ../rekisteroiyritys.php?error=salasana&kayttajatunnus=".$kayttajatunnus."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
		exit();
	}
	else{

        $sql = "SELECT kayttajatunnus FROM kayttaja WHERE kayttajatunnus = ?";
        $stmt = mysqli_stmt_init($yhteys);
        if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../rekisteroiyritys.php?error=tkks&kayttajatunnus=".$kayttajatunnus."&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $kayttajatunnus);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$tarkistus = mysqli_stmt_num_rows($stmt);
				if($tarkistus > 0){
					header("location: ../rekisteroiyritys.php?error=varattu&osoite=".$osoite."&postinumero=".$postinumero."&postitoimipaikka=".$postitoimipaikka."&puhelinnumero=".$puhelinnumero."&sahkopostiosoite=".$sahkopostiosoite."&ytmsnimi=".$ytmsnimi."&ytunnus=".$ytunnus."&laskutusnro=".$laskutusnro."&yhthenketunimi=".$yhthenketunimi."&yhthenksukunimi=".$yhthenksukunimi);
					exit();
                }
				else{
										
					$sql = "INSERT INTO kayttaja (kayttajaryhma_id, kayttajatunnus, osoite, postinumero, postitoimipaikka, puhelinnumero, sahkopostiosoite, ytmsnimi, ytunnus, laskutusnro, yhthenketunimi, yhthenksukunimi, salasana) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($yhteys);
					if(!mysqli_stmt_prepare($stmt, $sql)){
					header("location: ../rekisteroiyritys.php?error=tietosi");
					exit();
					}
					else{
						$hashedSalasana = password_hash($salasana, PASSWORD_DEFAULT); 
						
						mysqli_stmt_bind_param($stmt, "sssssssssssss", $kayttajaryhma_id, $kayttajatunnus, $osoite, $postinumero, $postitoimipaikka, $puhelinnumero, $sahkopostiosoite, $ytmsnimi, $ytunnus, $laskutusnro, $yhthenketunimi, $yhthenksukunimi, $hashedSalasana);
						mysqli_stmt_execute($stmt);
						header("location: ../index.php?rekisterointi=onnistunut");
					exit();
					}
				}
			}
			                        
    }
    
	mysqli_stmt_close($stmt);
    mysqli_close($yhteys);	
}
else {
	header("location: ../rekisteroiyritys.php");
    exit();
}
?>