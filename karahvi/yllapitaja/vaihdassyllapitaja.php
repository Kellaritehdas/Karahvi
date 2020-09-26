<?php
require "headery.php";
?>
		
<div class="container"> 
	<div class="panel panel-default">
	<div class="panel-heading"><center> Vaihda salasana </center></div>	
	<div class="wrapper">
        <p>Vähintään 6 merkkiä.</p>
        <form action="../inc/suoritavaihssyllapitaja.php" method="post"> 

                <label>Uusi salasana</label>
                <input type="password" name="new_salasana" class="form-control" placeholder="Uusi salasana">
				<br>
                <label>Toista salasana</label>
                <input type="password" name="confirm_salasana" class="form-control" placeholder="Toista uusi salasana">
				<input type="hidden" name="id" value="<?php  echo $_GET['id'];?>">
				<br>
				<div class="form-group">
                <input type="submit" name="vaihdasana" class="btn btn-primary" value="Vaihda">
                <a class="btn btn-default" href="omattiedotyllapitaja.php">Takaisin</a>
            </div>
        </form>
		</div>
	</div>
</div>		

<?php
require "footer.php";
?>