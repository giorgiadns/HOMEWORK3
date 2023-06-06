<?php 

error_reporting(E_ALL &~E_NOTICE);

session_start();

if (!isset($_SESSION['accessopermesso'])){
	header('Location:login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Prenotazioni</title>
	<link rel="stylesheet" href="marvel.css" type="text/css" />
	<style>
	@import url('https://fonts.cdnfonts.com/css/heroes-assemble');
	</style>
</head>

<body style="background-image:url('./immagini/sfondo.jpeg');background-attachment:fixed;background-size:cover;background-repeat:no-repeat;">
	
	<div style="filter: drop-shadow(0 0 0.6rem rgba(0,0,0));border-radius:15px;height:20%;width:60%;background-size:100%;background-color:black;text-align:center;">
	<h1 style="font-family:Heroes Assemble, sans serif;;color:red;font-size:50px;">LE TUE PRENOTAZIONI</h1>
	</div>
	
	<div style='width:30%;margin-top:10px;background-color:white;border-radius:15px;padding:0 0 0 0;'>
	<a href="film.php" style="width:100%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;width:100%;border-radius:15px;">Indietro</button></a>
	</div>

	<div style='filter: drop-shadow(0.6rem 0.6rem 0.6rem rgba(0,0,0));justify-content:center;border:2px solid red;margin-top:10px;border-radius:15px;height:35%;width:60%;background-size:100%;background-color:black;'>
	
<?php
	
	$idUser=$_SESSION['idUser'];
	$xmlString = "";
	foreach ( file("./fileXML/moviesPrenotati$idUser.xml") as $node ) {
		$xmlString .= trim($node);
	}
	
	$doc = new DOMDocument();
	
	$doc->loadXML($xmlString);
	
	$moviesPrenotati= $doc->documentElement;
	$filmPrenotati=$moviesPrenotati->childNodes;
	
	for ($i=0; $i<$filmPrenotati->length; $i++) {
		
		$element = $filmPrenotati->item($i);
		
		$id = $element->firstChild;
		$idValue = $id->textContent;
		$titolo = $id->nextSibling;
		$titoloText = $titolo->textContent;
		$anno = $titolo->nextSibling;
		$annoText = $anno->textContent;
		$durata = $anno->nextSibling;
		$durataText = $durata->textContent;
		$trama = $durata->nextSibling;
		$tramaText = $trama->textContent;
		$link = $element->lastChild;
		$linkText = $link->textContent;
		
			
			print"  <table>
				   <tr style='border-top:2px solid red;'>
				   <td colspan='2' style='font-family:Heroes Assemble, sans serif;background-color:white;border-bottom:2px solid red;border-top:2px solid red;text-transform:uppercase;color:red;font-size:45px;text-align:center;padding-left:30px;padding-top:10px;padding-bottom:10px;'>
				   $titoloText</td>
				   </tr>
				   <tr>
				   <td rowspan='5' style='text-align:center;vertical-align:top;'>
				   <img src='./immagini/$idValue.jpg' width='200px' style='margin:auto;align:center;padding-top:10px;padding-left:20px;'/>
				   </td>
				   </tr>
				   <td style='padding:20px 30px 0px 20px;'>
				   <h1 style='font-family:fantasy;font-size:20px;'>ANNO DI USCITA</h1> $annoText
				   </td>
				   </tr>
				   <tr>
				   <td style='padding:0px 30px 0px 20px;'>
				   <h1 style='font-family:fantasy;font-size:20px;'>DURATA</h1> $durataText
				   </td>
				   </tr>
				   <tr style='border-bottom:2px solid red;'>
				   <td style='padding:0px 30px 30px 20px;'>
				   <h1 style='font-family:fantasy;font-size:30px;'>TRAMA</h1> $tramaText
				   </td>
				   </tr>
				   </table>
				  ";
		}
		
		?>
</div>
</body>
</html>