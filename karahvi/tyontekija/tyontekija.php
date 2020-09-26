<?php
require "headert.php";
?>

<div class="container">   	
    <center>
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"> Tervetuloa <b><?php echo htmlspecialchars($_SESSION["kayttajatunnus"]); ?></b>!</div>
			<div class="panel-body"> Muista kirjautua ulos <br>
										pois lähtiessäsi. <br></div>
		</div>
	</div>
	</center>
</div>
	
<?php
require "footer.php";
?> 