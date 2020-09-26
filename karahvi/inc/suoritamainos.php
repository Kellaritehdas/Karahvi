<?php
if(isset($_POST['mainoskantaan'])){
require 'config.php';

$kuva = $_FILES['image']['name'];
$kuvannimi = $_POST['name'];

$setpicture="insert into mainokset (kuva_kuva, kuva_nimi) values  ('$kuva', '$kuvannimi')";
$tulos = $yhteys->query($setpicture);

	if ($tulos === TRUE) {
		move_uploaded_file($_FILES['image']['tmp_name'], "../mainokset/$kuva");
		header("location: ../yllapitaja/mainokset.php?success");
		exit();
	} 
	header("location: ../yllapitaja/mainoskuva.php?error=tietokantalisayseitoimi");
    exit();
}
else{
	header("location: ../yllapitaja/mainoskuva.php?error=eitoimiei");
    exit();
}
?>