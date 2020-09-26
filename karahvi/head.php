<?php
session_start();
require "mainos.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KARAHVI</title>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="karahvi.css">
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <style>

  </style>
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
		  
          <a class="navbar-brand" href="index.php">KARAHVI</a>
        </div>
		
        <div class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-right">
		<div class="head-login">	
		
		<form action="inc/login.php" method="post">		
		<input type="text" name="kayttajatunnus" pattern="[a-zA-Z0-9]+" placeholder="Käyttäjätunnus" style="width:200px">
		<input type="password" name="salasana" placeholder="Salasana" style="width:200px">
		<button type="submit" name="kirjaudu"/>
		<span class="glyphicon glyphicon-log-in"></span> Kirjaudu</button>
		</form>
				
			<li><a href="rekisterointi.php" ><span class="glyphicon glyphicon-user"></span> Rekisteröidy</a></li>
			<li><a href="yhteystiedot.php" >Yhteystiedot</a></li>
			
          </ul>
		  </div>
        </div>
      </div>
    </div>
  </header>