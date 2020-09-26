<?php
session_start();
require "../inc/config.php";
if(!isset($_SESSION['id'])){
	header("location: ../main.php?error=kirjaudu");
	exit();
}
if($_SESSION['kayttajaryhma_id'] != 1){
	header("location: ../main.php?error=väärä_kayttäjäryhmä");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KARAHVI / YLLÄPITÄJÄ</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../karahvi.css">
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
<body>
    <div class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>		  
				<a class="navbar-brand" href="yllapitaja.php">KARAHVI</a>
			</div>
        <div class="collapse navbar-collapse">
		
			<ul class="nav navbar-nav">      
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">Tuotehallinta
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="tuotteenlisays.php">Lisää uusi tuote</a></li>
			<li><a href="tuoteryhmanlisays.php">Lisää uusi tuoteryhmä</a></li>
			<li><a href="tuoteryhmatyllapitaja.php">Muokkaa tuoteryhmiä</a></li>
			</ul>
			</li>
			</ul>		
			<ul class="nav navbar-nav">      
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">Tuotetiedot
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<!-- ryhmien haku menuun db:stä -->
			<?php
			$hakusql = "SELECT * FROM tuoteryhma";
			$tulokset = $yhteys->query($hakusql);
			// jos tulosrivejä löytyi
			if ($tulokset->num_rows > 0) {
			while($rivi = $tulokset->fetch_assoc()) {
			?>   
			<form action="tuotteetsisallot.php" method="get">
			<input type="hidden" name="ryhma" value="<?php echo $rivi["ryhma_id"]; ?>" />
			<input type="hidden" name="ryhmanimi" value="<?php echo $rivi["ryhma_nimi"]; ?>" />
			<input type="hidden" name="kuvaus" value="<?php echo $rivi["kuvaus"]; ?>" />
			<input type="submit" class="button" value='<?php echo $rivi["ryhma_nimi"];?>'>
			</form>
			<?php   }
			} else {
				echo "Ei tuloksia!";
			}
			?>
		
		<!-- ryhmien haku menuun db:stä loppuu -->
			</ul>
			</li>
			</ul>		
			<ul class="nav navbar-nav">      
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">Käyttäjälistat
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="yllapitajat.php">Ylläpitäjät</a></li>
			<li><a href="tyontekijat.php">Työntekijät</a></li>
			<li><a href="henkilot.php">Henkilöasiakkaat</a></li>
			<li><a href="yritykset.php">Yritykset</a></li>
			</ul>
			</li>
			</ul>		
			<ul class="nav navbar-nav">      
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">Lisää käyttäjä
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="lisaayllapitaja.php">Ylläpitäjä</a></li>
			<li><a href="lisaatyontekija.php">Työntekijä</a></li>
			<li><a href="lisaahenkilo.php">Henkilöasiakas</a></li>
			<li><a href="lisaayritys.php">Yritys</a></li>
			</ul>
			</li>
			</ul>		
			<ul class="nav navbar-nav">      
			<li><a href="mainokset.php">Mainokset</a></li>
			</ul>
		
			<ul class="nav navbar-nav navbar-right">
			<li><a href="omattiedotyllapitaja.php" ><span class="glyphicon glyphicon-user"></span> Omat tiedot</a></li>
			<li><a href="logout.php" ><span class="glyphicon glyphicon-log-out"></span> Kirjaudu ulos</a></li>
          </ul>
        </div>
      </div>
    </div>