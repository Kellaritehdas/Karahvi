<?php 
if(isset($_POST['kirjaudu'])){
	
	require 'config.php';
	
	$kayttajatunnus = trim($_POST['kayttajatunnus']);
	$salasana = trim($_POST['salasana']);
	
	if (empty($kayttajatunnus) || empty($salasana)) {
		header("location: ../index.php?error=tyhja_kenttä");
		exit();
	}
	else{
		$sql = "SELECT * FROM kayttaja WHERE kayttajatunnus = ?";
		$stmt = mysqli_stmt_init($yhteys);
        if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../index.php?error=sqlvirhe");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $kayttajatunnus);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if($row = mysqli_fetch_assoc($result)){
			if($row['aktiivinen'] === 1){
				$salasanatarkistus = password_verify($salasana, $row['salasana']);
				if($salasanatarkistus == false){
					header("location: ../index.php?error=väärä_salasana");
					exit();
				}elseif($salasanatarkistus == true){
					//kirjautuminen ok
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['kayttajaryhma_id'] = $row['kayttajaryhma_id'];
                    $_SESSION['kayttajatunnus'] = $row['kayttajatunnus'];
					
					if($row['kayttajaryhma_id'] == 1){header("location: ../yllapitaja/yllapitaja.php");exit();}
					if($row['kayttajaryhma_id'] == 2){header("location: ../tyontekija/tyontekija.php");exit();}
					if($row['kayttajaryhma_id'] == 3){header("location: ../asiakas/kirjautunut.php");exit();}
					if($row['kayttajaryhma_id'] == 4){header("location: ../asiakas/kirjautunut.php");exit();}
					
					
				}
				else{
					header("location: ../index.php?error=väärä_salasana");
					exit();
				}
				}
				else{
					header("location: ../index.php?error=tili_ei_ole_aktiivinen");
				exit();
				}
			
			}
			else{
				header("location: ../index.php?error=käyttäjä_tuntematon");
				exit();
			}
		}
	}
}
else {
	header("location: ../index.php");
	exit();
}
?>