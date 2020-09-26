<?php
if(isset($_POST['vaihdasana'])){
require 'config.php';


    if(empty(trim($_POST["new_salasana"]))){
        header("location: ../vaihdassyllapitaja.php?error=syotasalasana");
		exit();   
    } elseif(strlen(trim($_POST["new_salasana"])) < 6){
        header("location: ../vaihdassyllapitaja.php?error=salasanaliianlyhyt");
		exit();
    } else{
        $new_salasana = trim($_POST["new_salasana"]);
    }
    

    if(empty(trim($_POST["confirm_salasana"]))){
        header("location: ../vaihdassyllapitaja.php?error=toistasalasana");
		exit();
    } else{
        $confirm_salasana = trim($_POST["confirm_salasana"]);
        if(empty($new_salasana_err) && ($new_salasana != $confirm_salasana)){
            header("location: ../vaihdassyllapitaja.php?error=salasanateivattasmaa");
			exit();
        }
    }
        



        $sql = "UPDATE kayttaja SET salasana = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($yhteys, $sql)){

            mysqli_stmt_bind_param($stmt, "si", $param_salasana, $param_id);

            $param_salasana = password_hash($new_salasana, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($stmt)){

                header("location: ../yllapitaja/omattiedotyllapitaja.php?success");
                exit();
            } else{
                echo "Jotain meni pieleen. Yritä myöhemmin uudelleen.";
            }
        }
        mysqli_stmt_close($stmt);
    
    mysqli_close($yhteys);
}
else{
	header("location: ../yllapitaja/omattiedotyllapitaja.php?error");
    exit();
}
?>