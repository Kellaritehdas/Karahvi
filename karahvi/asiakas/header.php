<?php
session_start();
require "../inc/config.php";
if(!isset($_SESSION['id'])){
	header("location: ../main.php?error=kirjaudu");
	exit();
}
if($_SESSION['kayttajaryhma_id'] == 1 || $_SESSION['kayttajaryhma_id'] == 2){
	header("location: ../main.php?error=väärä_kayttäjäryhmä");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KARAHVI / KIRJAUTUNUT</title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../karahvi.css">
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  
  <body>

	<header>
	    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
          <a class="navbar-brand" href="kirjautunut.php">KARAHVI</a>
        </div>
        <div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
		<li><a href="tuotteet.php">Tilaa tästä</a></li>    
		</ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="omattilaukset.php" ><span class="glyphicon glyphicon-list-alt"></span> Tilaushistoria</a></li>
			<li><a href="omattiedot.php" ><span class="glyphicon glyphicon-user"></span> Omat tiedot</a></li>
			<li><a href="yhteystiedotkirjautunut.php" >Yhteystiedot</a></li>
			<li><a href="logout.php" ><span class="glyphicon glyphicon-log-out"></span> Kirjaudu ulos</a></li>
          </ul>
        </div>
      </div>
    </div>
	</header>