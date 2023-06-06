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
	<title>Movies</title>
	<link rel="stylesheet" href="marvel.css" type="text/css" />
	<style>
	@import url('https://fonts.cdnfonts.com/css/heroes-assemble');
	</style>
</head>

<body style="background-image:url('./immagini/sfondo.jpeg');background-attachment:fixed;background-size:cover;background-repeat:no-repeat;">

	<div style="filter: drop-shadow(0.5rem 0.5rem 0.5rem rgba(0,0,0));border-radius:15px;height:25%;width:50%;background-size:100%;background-color:white;text-align:center;">
	<img src="./immagini/marvel-logo.png" width="80%" height="270px" style="align:center;"/>
	</div>
	
	<div style='width:50%;margin-top:20px;background-color:white;border-radius:15px;padding:0 0 0 0;-'>
	<a href="filmPrenotati.php" style="width:33%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;width:100%;border-right:2px solid red;border-top-left-radius:15px;border-bottom-left-radius:15px;">Prenotazioni</button></a>
	<a href="guardianidellagalassia.html" style="width:33%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;width:100%;border-right:2px solid red;">Coming soon</button></a>
	<a href="logout.php" style='width:34%;'>
	<button class="button" style="font-family:Heroes Assemble, sans serif;border-top-right-radius:15px;border-bottom-right-radius:15px;width:100%;border-right:2px solid red;">Logout</button></a>
	</div>
	
	<?php
		
	$xmlString = "";
	foreach ( file("./fileXML/movies.xml") as $node ) {
		$xmlString .= trim($node);
	}
	
	$doc = new DOMDocument();
	
	$doc->loadXML($xmlString);
	
	$movies= $doc->documentElement;
	$film=$movies->childNodes;
	
	for ($i=0; $i<$film->length; $i++) {
		
		$element = $film->item($i);
		
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
		
		print "<form action='schedafilm.php' method='POST'>
			   <div style='filter: drop-shadow(0 0 0.75em rgba(0,0,0));text-transform:uppercase;justify-content:center;border:2px solid red;margin-top:10px;border-radius:15px;height:25%;width:50%;background:#070707;'>
			   <table>
			   <tr style='border-top:2px solid gray;'>
			   <td style='font-family:Heroes Assemble, sans serif;color:white;font-size:60px;text-align:center;padding-left:30px;padding-top:10px;'>
			  $titoloText</td>
			   </tr>
			   <tr>
			   <td style='text-align:center;'>
			   <img src='./immagini/$idValue.jpg' width='400px' style='margin:auto;align:center;padding-top:10px;'/>
			   </td>
			   </tr>
			   <tr>
			   <td style='text-align:center;'>
			   <input type='hidden' name='idPOST' value='$idValue' />
			   <input type='submit' class='button' value='Prenota il biglietto' name='invio' style='border-radius:15px;width:250px;border-right:2px solid red;background-color:red;color:white;margin-top:10px;'>
			   </td>
			   </tr>
			   </table>
			   </div>
			   </form>";
	}
	?>
	
</body>
</html>