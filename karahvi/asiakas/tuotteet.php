<?php
error_reporting(0);
$currency = "€";
require "header2.php";

	// Lisää tuote koriin
	if (empty($_POST['tuote']) ||empty($_POST['ryhma']) ||empty($_POST['tavara']) || empty($_POST['hinta']) || empty($_POST['kplmaara']))
	{ } else {

		# Arvot
		$tuote = $_POST['tuote'];
		$ryhma = $_POST['ryhma'];
		$kplhinta = $_POST['hinta'];
		$ostettava = $_POST['tavara'];
		$korinkplmaara = $_POST['kplmaara'];
		$koriluotu = false;
		$korilaskuri = 0;
		// Onko sessio luotu?
		if($_SESSION['ostokset']!="")
		{
			// Onko tuotetta
			foreach($_SESSION['ostokset'] as $korintuote)
			{
				// Kyllä löytyy tuote
				if($ostettava == $korintuote['tavara']) {
					$koriluotu = true;
					break;
				}
				$korilaskuri++;
			}
		}
		// Jos sama tuote
		if($koriluotu)
		{
			// Päivitä kplmaara
			$_SESSION['ostokset'][$korilaskuri]['kplmaara'] += $korinkplmaara;
			
		} else {

			// Jos ei tuotetta, aseta uusi tuote
			$korinrivi = array(
				'tuote' => $tuote,
				'ryhma' => $ryhma,
				'tavara' => $ostettava,
				'yksikkohinta' => $kplhinta,
				'kplmaara' => $korinkplmaara,
			);

			// Jos seissiota ei ole luotu, luo sessio
			if (!isset($_SESSION['ostokset']))
				$_SESSION['ostokset'] = array();

			// Lisää tuote koriin
			$_SESSION['ostokset'][] = $korinrivi;			
		}
	}

	if(isset($_GET["clear"]))
	{
		unset($_SESSION['ostokset']);
	}

	// POista tuote korista (Päivitä kplmaara 0)
	$remove = isset($_GET['remove']) ? $_GET['remove'] : '';
	if($remove!="")
	{
		$_SESSION['ostokset'][$_GET["remove"]]['kplmaara'] = 0;
	}
	?>

<body>  
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<?php if(isset($_GET["varmista"])) { header("location: tilauskooste.php");?>
			<div class="panel panel-success">			 
			<?php }  
				$tuoteryhma = $_GET['ryhma'];
				$ryhmanimi = $_GET['ryhmanimi'];
				$ryhmakuvaus = $_GET['ryhmakuvaus'];
				$hakusql = "SELECT *, FORMAT(hinta,2) FROM tuote where tuote.ryhma_id = ('$tuoteryhma')";
				$tulokset = $yhteys->query($hakusql);
			?>
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span> <?php echo $ryhmakuvaus; ?>				
					</div>
				<ul class="list-group">
				<?php
				// jos tulosrivejä löytyi
				if ($tulokset->num_rows > 0) {
					while($rivi = $tulokset->fetch_assoc()) {
				?>   
				<li class="list-group-item">
					<form action="?ryhma=<?php echo $tuoteryhma; ?>&ryhmakuvaus=<?php echo $ryhmakuvaus; ?>" method="post">
						<strong><?php echo $rivi["tuotenimi"];?></strong>
						<span class="pull-right"><?php echo $rivi["FORMAT(hinta,2)"]." " . $currency;?></span><br>
						<span class="pull-right"><?php echo "Sis.alv";?></span><br>
						<?php if(!empty($rivi["kuva"])){echo '<img src="../image/'.$rivi["kuva"].'" height="125px"/>'.'<br>'.'<br>'; }?>
						Tuotesisältö: <?php echo $rivi["raakaaine"];?><br>
						Lisätiedot: <?php echo $rivi["lisatiedot"];?><br><br>
						<span class="pull-right">
						<input class="form-control kplmaara" name="kplmaara" type="number" maxlength="3" value="1">
						
					<!-- Joku fiksu vois laittaa + ja - napit toimimaan
						<button  class="btn btn-success btn-sm" onClick="this.parentNode.querySelector('[type=number]').stepUp();"> + </button>
						<button  class="btn btn-danger btn-sm" onClick="this.parentNode.querySelector('[type=number]').stepDown();"> - </button>
					-->	
						<input type="submit" name="lisaa" value="Lisää" class="btn btn-primary btn-sm">						
						</span><br><br>
						<input type="hidden" name="tuote" value="<?php echo $rivi["tuote_id"]; ?>" />
						<input type="hidden" name="ryhma" value="<?php echo $rivi["ryhma_id"]; ?>" />
						<input type="hidden" name="tavara" value="<?php echo $rivi["tuotenimi"]; ?>" />
						<input type="hidden" name="hinta" value="<?php echo $rivi["FORMAT(hinta,2)"]; ?>" />
					</form>
				</li>
				<?php   }
				} else {
					echo "<br>";
					?><div id="ts">Valitse tuoteryhmä ylävalikosta!</div><?php
					echo "<br>";		
				}
				?>
				</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6" id="sidebar" role="navigation">
				<div class="sidebar-nav">
					<?php
					// If cart is empty
					if (!isset($_SESSION['ostokset']) || (count($_SESSION['ostokset']) == 0)) {
					?>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> Ostoskori</h3>
					  </div>
					  <div class="panel-body">Ostoskorisi on tyhjä..</div>
					</div>
					<?php
					// If cart is not empty
					} else {
					?>
					<div class="panel panel-default">
						<div class="panel-heading" style="margin-bottom:0;">
							<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> Ostoskori</h3>
						</div>
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
		
								// Write cart to screen
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
							</table>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"> Tilauskoosteeseen </h3>
						</div>
						<div class="panel-body">
						<form role="form" method="post" action="tilauskooste.php">
							<div class="form-group">
								<div>
									<button type="submit" class="btn btn-success pull-right"> Jatka </button>
								</div>
							</div>
							<input type="hidden" name="yhteensa" value="<?php echo $yhteensa;?>">				
						</form>
						</div>
					</div>				
					<?php } ?>
				</div>
			</div>
		</div>
    </div>
</div>

<?php
require "footer.php";
?> 