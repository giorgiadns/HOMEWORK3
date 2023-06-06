<?php 

error_reporting(E_ALL &~E_NOTICE);

session_start();
unset($_SESSION);
session_destroy();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Logout</title>
	<link rel="stylesheet" href="marvel.css" type="text/css" />
	<style>
	@import url('https://fonts.cdnfonts.com/css/heroes-assemble');
	</style>
	
</head>

<body style="background-image:url('./immagini/sfondo.jpeg');background-attachment:fixed;background-size:cover;background-repeat:no-repeat;">

	<div style="filter: drop-shadow(0.6rem 0.6rem 0.6rem rgba(0,0,0));border-radius:15px;height:25%;width:50%;background-size:100%;background-color:white;text-align:center;">
	<img src="./immagini/marvel-logo.png" width="80%" height="270px" style="align:center;"/>
	</div>
	
	<div style="filter: drop-shadow(0.6rem 0.6rem 0.6rem rgba(0,0,0));margin-top:20px;border-radius:10px;width:50%;justify-content:center;padding-left:10px;background-color:red;border:2px solid white;">
	<h1 style="color:white;font-family:Heroes Assemble, sans serif;width:100%;">GRAZIE DELLA VISITA!</h1>
	<a href='login.php' style="width:25%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;border-radius:15px;width:100%;border-right:2px solid red;">Torna al login</button></a>
	</div>


</body>
</html>