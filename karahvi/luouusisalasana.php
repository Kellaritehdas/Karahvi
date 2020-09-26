<?php
//error_reporting(0);
require "head.php";
?>
<div class="container"> 
	<div class="panel panel-default">
		<div class="panel-heading"><center> Kirjoita uusi salasana </center></div>	
		<div class="wrapper">
			<p>Vähintään 6 merkkiä.</p>

			<?php
			$muuttuja = $_GET['muuttuja'];
			$valinta = $_GET['valinta'];
			
			if(empty($muuttuja) || empty($valinta)){
				echo "Emme tunnista pyyntöäsi!";
				echo $muuttuja;
				echo $valinta;
			}
			else {
				if(ctype_xdigit($muuttuja) !== false && ctype_xdigit($valinta)  !== false){
					?>
					<form action="inc/uusisssuorita.php" method="post">
					<input type="hidden" name="muuttuja" value="<?php echo $muuttuja?>">
					<input type="hidden" name="valinta" value="<?php echo $valinta?>">
					<input type="password" name="uusisalasana" minlength="6" class="form-control" placeholder="Kirjoita uusi salasana" required><br>
					<input type="password" name="confirm_salasana" minlength="6" class="form-control" placeholder="Toista uusi salasana" required><br>
					<input type="submit" class="btn btn-primary" name="submit-uusiss" value="Uusi salasana">
					<input type="reset" class="btn btn-default" value="Tyhjennä">
					</form>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>

 <?php
require "foot.php";
?>  