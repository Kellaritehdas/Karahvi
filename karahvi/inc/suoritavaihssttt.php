<?php
if(isset($_POST['vaihdasana'])){
require 'config.php';


    if(empty(trim($_POST["new_salasana"]))){
        header("location: ../vaihdasstyontekijat.php?error=syotasalasana");
		exit();   
    } elseif(strlen(trim($_POST["new_salasana"])) < 6){
        header("location: ../vaihdasstyontekijat.php?error=salasanaliianlyhyt");
		exit();
    } else{
        $new_salasana = trim($_POST["new_salasana"]);
    }
    

    if(empty(trim($_POST["confirm_salasana"]))){
        header("location: ../vaihdasstyontekijat.php?error=toistasalasana");
		exit();
    } else{
        $confirm_salasana = trim($_POST["confirm_salasana"]);
        if(empty($new_salasana_err) && ($new_salasana != $confirm_salasana)){
            header("location: ../vaihdasstyontekijat.php?error=salasanateivattasmaa");
			exit();
        }
    }
        



        $sql = "UPDATE kayttaja SET salasana = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($yhteys, $sql)){

            mysqli_stmt_bind_param($stmt, "si", $param_salasana, $param_id);

            $param_salasana = password_hash($new_salasana, PASSWORD_DEFAULT);
            $param_id = $_POST["id"];
            
            if(mysqli_stmt_execute($stmt)){

                header("location: ../yllapitaja/tyontekijat.php?success");
                exit();
            } else{
                echo "Jotain meni pieleen. Yritä myöhemmin uudelleen.";
            }
        }
        mysqli_stmt_close($stmt);
    
    mysqli_close($yhteys);
}
else{
	header("location: ../yllapitaja/tyontekijat.php?error");
    exit();
}
?>