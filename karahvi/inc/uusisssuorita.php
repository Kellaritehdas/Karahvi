<?php
if(isset($_POST['submit-uusiss'])){
	
	$muuttuja = $_POST['muuttuja'];
	$valinta = $_POST['valinta'];
	$uusisalasana = trim($_POST['uusisalasana']);
	$confirm_salasana = trim($_POST['confirm_salasana']);
	
	if(empty($uusisalasana) || empty($confirm_salasana)){
			header("location: ../luouusisalasana.php?error=empty");
			exit();
	}
	elseif ($uusisalasana != $confirm_salasana){
			header("location: ../luouusisalasana.php?error=sanat");
			exit();
	}
	
	$pvm = date("U");
	require 'config.php';
		
	$sql = "SELECT * FROM uusiss WHERE uusissMuuttuja = ? AND uusissVoimassa >= ?;";
	$stmt = mysqli_stmt_init($yhteys);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Pyyntö ei ole enää voimassa!";
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "ss", $muuttuja, $pvm);
		mysqli_stmt_execute($stmt);
		
		$tulos = mysqli_stmt_get_result($stmt);
		if(!$row = mysqli_fetch_assoc($tulos)){
			echo "Virhe varmennuksessa!";
			exit();
		}
		else{
			$tokenBin = hex2bin($valinta);
			$tokenTarkistus = password_verify($tokenBin, $row['uusissToken']);			
			if($tokenTarkistus === false){
				echo "Virhe pyynnön varmennuksessa!";
				exit();				
			}
			elseif($tokenTarkistus === true){
				$tokenEmail = $row['uusissEmail'];
				
				$sql = "SELECT * FROM kayttaja WHERE sahkopostiosoite = ?;";
				$stmt = mysqli_stmt_init($yhteys);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo "Virhe yhteydessä!";
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$tulos = mysqli_stmt_get_result($stmt);
					if(!$row = mysqli_fetch_assoc($tulos)){
						echo "Virhe sähköpostiosoitteen varmennuksessa!";
						exit();
					}
					else{
						$sql = "UPDATE kayttaja SET salasana = ? WHERE sahkopostiosoite = ?;";
						$stmt = mysqli_stmt_init($yhteys);
						if(!mysqli_stmt_prepare($stmt, $sql)){
							echo "Virhe yhteydessä!";
							exit();
						}
						else{
							
							$hasheduusisalasana = password_hash($uusisalasana, PASSWORD_DEFAULT);
							//$muokaika= date("Y-m-d h:i:sa");
							mysqli_stmt_bind_param($stmt, "ss", $hasheduusisalasana, $tokenEmail);
							mysqli_stmt_execute($stmt);
							
							$sql = "DELETE FROM uusiss WHERE uusissEmail = ?;";
							$stmt = mysqli_stmt_init($yhteys);
							if(!mysqli_stmt_prepare($stmt, $sql)){
								echo "Virhe yhteydessä!";
								exit();
							}
							else{
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../index.php?uusiss");
							}
						}
					}
				}
					
			}
	
		}
	}
}	
else{
	header("location: ../index.php");
	exit();

}

?>