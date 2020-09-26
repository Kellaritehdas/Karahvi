<?php
require "header.php";
$currency = "€";

	
	// Tyhjennä ostoskori
	if(isset($_GET["clear"]))
	{
		unset($_SESSION['ostokset']);
	// Tyhjennä kaikki sessioon kuuluvat tilausnumerot	
		$sessioid = session_id();	
			$hakusql = "SELECT * FROM tilausnumero
			where sessiotunnus = ('$sessioid') and aktiivinen = ('0')";
		$tulos = $yhteys->query($hakusql);	
		
		if ($tulos->num_rows > 0) {
			
			while($rivi = $tulos->fetch_assoc()) {
				
			$remove = "DELETE FROM karahvi.tilausnumero WHERE tilausnumero.sessiotunnus = ('$sessioid') and aktiivinen = ('0')";
			$result = mysqli_query($yhteys,$remove) or die ( mysqli_error());
			
			}
		}

	}
	
	// Poista tuote ostoskorista (Määritä kplmaara 0)
	$remove = isset($_GET['remove']) ? $_GET['remove'] : '';
	if($remove!="") {
		$_SESSION['ostokset'][$_GET["remove"]]['kplmaara'] = 0;
	}
	
?>


	<!-- Kalenteri -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	  $( function() {
		$( "#datepicker" ).datepicker({dateFormat: "dd.mm.yy", autoSize: true, minDate: 1, firstDay: 1,
		dayNamesMin: [ "Su", "Ma", "Ti", "Ke", "To", "Pe", "La" ], 
		
		monthNames: [ "Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu" ],
		altField: "#alternate",
		altFormat: "yy-mm-dd"
		});
	  } );
	</script>
  
<body>
    <div class="container">
		<center>
        <div class="col-xs- col-sm-12" id="sidebar" role="navigation">
          
			<?php
			// Jos ostoskori on tyhjä
			if (!isset($_SESSION['ostokset']) || (count($_SESSION['ostokset']) == 0)) {
			?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> Tilauskooste & toimitus</h3>
				  </div>
				  <div class="panel-body">Ostoskorisi on tyhjä...</div>
				</div>
			<?php
			// Jos ostoskorissa on tuotteita
			} else {
				?>
				
				<div class="panel panel-success">
				  <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Tilauskooste & toimitus</div>
				  <br>			
				  				 				  
					<div class="table-responsive">
					<table class="table">
						<tr class="tableactive"><th>Tuote</th><th>Hinta</th><th>Määrä</th><th>Yhteensä</th></tr>
						<?php

						$yhteensa = 0;

						$rivinumero = 0;

						foreach($_SESSION['ostokset'] as $ostettava)
						{

							if($ostettava['kplmaara']!=0) {
								
							$yhteensadecimal = (float)$ostettava['yksikkohinta']*$ostettava['kplmaara'];

							// Näytä ostoskorin sisältö
							echo
							"
							<tr class='tablerow'>
								<td><a href=\"?remove=".$rivinumero."\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Poistetaanko tuote?')\">X</a> ".$ostettava['tavara']."</td>
								<td>".$ostettava['yksikkohinta']." ".$currency."</td>
								<td>".$ostettava['kplmaara']."</td>
								<td>".number_format($yhteensadecimal,2)." ".$currency."</td>
							</tr>
							";

							// yhteensa
							$yhteensa += $yhteensadecimal;
							$yhteensaalv = $yhteensa * 0.14;
							$yhteensaton = $yhteensa - $yhteensaalv;
							}
							$rivinumero++;
						}																			
						?>
						
						<tr class='tableactive'>
							<td><a href='?clear' class='btn btn-danger btn-xs' onclick="return confirm('Haluatko varmasti tyhjentää ostoskorin?')">Tyhjennä ostoskori</a></td>
							<td class='text-right'>Loppusumma:</td>
							<td><?php  ?></td>
							<td><?php echo number_format($yhteensa,2);?> €</td>
						</tr>
						<tr class='tableactive'>
							<td><?php  ?></td>
							<td class='text-right'>Alv 14%:</td>
							<td><?php  ?></td>
							<td><?php echo number_format($yhteensaalv,2);?> €</td>
						</tr>
						<tr class='tableactive'>
							<td><?php  ?></td>
							<td class='text-right'>Alvton:</td>
							<td><?php  ?></td>
							<td><?php echo number_format($yhteensaton,2);?> €</td>
						</tr>
						
					</table>
					</div>
					<br>
					<form role="form" method="post" action="../inc/tilaus.php">
					<div class="panel-body"><label> Toimituspäivämäärä ja aika. </label><br><br>	
						<div id ="tp">Päivämäärä: <input type="text" class="form-control" id="datepicker" required></div><br>
						Kellonaika: <input type="time" class="form-control" id ="ttt" min="7.30" max="22.00" name="toimaika" required><br>
						<div id="toimjamaks">
						<label>Valitse tilauksen nouto tai kuljetus:</label><br>
						
							<input type="radio" id="nouto" name="toimituspaikka" value="nouto" checked>
							Tilaus noudetaan toimipisteestä.<br>
							<input type="radio" id="toimitus" name="toimituspaikka" value="toimitus">
							Tilaus toimitetaan asiakkaalle.<br><br>
					
						<label>Valitse tilauksen maksutapa:</label><br>
							<input type="radio" id="nouto" name="maksaminen" value="2">
							Maksetaan noudon yhteydessä. <br>
							<input type="radio" id="toimitus" name="maksaminen" value="1">
							Maksetaan toimituksen yhteydessä.<br>
							<input type="radio" id="lasku" name="maksaminen" value="0" checked>
							Lasku. Lähetetään toimituksen jälkeen.<br>
						</div>		
						<br>
						<div class="panel-body"><label> Lisätietoja </label><br>
						<textarea name="lisatiedot" rows="4" class="form-control" ></textarea>
						</div>
						<br>
						<br>
				
						<div class="form-group">
						<div><button type="submit" class="btn btn-success" style="margin: auto"> HYVÄKSY TILAUS </button></div>
						</div>
						<input type="hidden" id="alternate" name="alternate" value="">
					</form>
					</div>				  
				</div>
			<?php } ?>
		</div>
		</center>
	</div>
	
<?php
require "footer.php";
?> 