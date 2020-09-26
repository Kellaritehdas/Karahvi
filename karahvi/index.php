<?php
require "head.php";
?>
   
<div class="container">   	
    <center>
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> Tervetuloa Karahvin Demoon!</div>
			<div class="panel-body"> Täältä voit tilata leikisti tuotteita kahvista illallisiin. <br>
				Rekisteröidy tai kirjaudu sisään. <br><br>
				
				<a href="uusisalasana.php">Salasana unohtunut? </a>
				
			</div>
			<?php
			if(isset($_GET['rekisterointi'])){
				echo '<p class="rekok">Rekisteröinti onnistui! Kirjaudu sisään.</p>';
			}
			if(isset($_GET['uusiss'])){
				echo '<p class="rekok">Uusi salasana rekisteröity! Kirjaudu sisään.</p>';
			}
			if(isset($_GET['error'])){
				if($_GET['error'] == "käyttäjä_tuntematon"){
					echo '<p class="rekvirhe">Tuntematon käyttäjätunnus!</p>';
				}
				else if($_GET['error'] == "tili_ei_ole_aktiivinen"){
					echo '<p class="rekvirhe">Tilisi ei ole aktiivinen!</p>';
				}
				else if($_GET['error'] == "väärä_salasana"){
					echo '<p class="rekvirhe">Väärä salasana!</p>';
				}
				else if($_GET['error'] == "sqlvirhe"){
					echo '<p class="rekvirhe">Tietokantavirhe! Kokeile uudelleen!</p>';
				}
			}
			
			?>
			<div class="mainoslaatikko">
			   <h3 align="center">Tarjoukset ja uutiset</h3>
			   <br />
			    <?php if(!empty(make_slides($yhteys))){ ?>
			   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				<?php echo make_slide_indicators($yhteys); ?>
				</ol>

				<div class="carousel-inner">
				 <?php echo make_slides($yhteys); ?>
				</div>
				<a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
				 <span class="glyphicon glyphicon-chevron-left"></span>
				 <span class="sr-only">Edellinen</span>
				</a>

				<a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
				 <span class="glyphicon glyphicon-chevron-right"></span>
				 <span class="sr-only">Seuraava</span>
				</a>

				</div>
				<?php } ?>
			</div>
		</div>		
	</div>
	</center>
</div>

 <?php
require "foot.php";
?>    