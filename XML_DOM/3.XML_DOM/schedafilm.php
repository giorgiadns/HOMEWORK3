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
	<title>Scheda film</title>
	<link rel="stylesheet" href="marvel.css" type="text/css" />
	<style>
	@import url('https://fonts.cdnfonts.com/css/heroes-assemble');
	</style>
</head>

<body style="background-image:url('./immagini/sfondo.jpeg');background-attachment:fixed;background-size:cover;background-repeat:no-repeat;">

	<div style='width:80%;margin-top:10px;background-color:white;border-radius:15px;padding:0 0 0 0;'>
	<a href="filmPrenotati.php" style="width:50%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;border-top-left-radius:15px;border-bottom-left-radius:15px;width:100%;border-right:2px solid red;">Prenotazioni</button></a>
	<a href="film.php" style="width:50%;">
	<button class="button" style="font-family:Heroes Assemble, sans serif;width:100%;border-top-right-radius:15px;border-bottom-right-radius:15px;">Indietro</button></a>
	</div>
	
<?php

$idPOST=$_POST['idPOST'];
$idUser=$_SESSION['idUser'];

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
		
		/*Stampo solo il film il cui id=idPOST*/
		if(strcmp($idPOST,$idValue)==0){
			
			$idPrenot=$idValue;
			$titoloPrenot=$titoloText;
			$durataPrenot=$durataText;
			$tramaPrenot=$tramaText;
			$annoPrenot=$annoText;
			$linkPrenot=$linkText;
			
			print "<form action='schedafilm.php' method='POST'>
				   <div style='justify-content:center;border:2px solid red;margin-top:10px;border-radius:15px;height:35%;width:80%;background-size:100%;background-color:black;'>
				   <table>
				   <tr style='border-top:2px solid gray;'>
				   <td colspan='2' style='font-family:Heroes Assemble, sans serif;border-bottom:2px solid red;text-transform:uppercase;color:red;font-size:80px;text-align:center;padding-left:30px;padding-top:10px;'>
				   $titoloText</td>
				   </tr>
				   <tr>
				   <td rowspan='5' style='text-align:center;vertical-align:top;'>
				   <img src='./immagini/$idValue.jpg' width='350px' style='margin:auto;align:center;padding-top:10px;padding-left:20px;'/>
				   <input type='submit' class='button' value='Prenota il biglietto' name='prenota' style='vertical-align:top;border-radius:15px;width:250px;border-right:2px solid red;background-color:red;color:white;margin-top:20px;'>
				   <input type='hidden' name='idPOST' value='$idPOST' />
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
				   <tr>
				   <td style='padding:0px 30px 30px 20px;'>
				   <h1 style='font-family:fantasy;font-size:30px;'>TRAMA</h1> $tramaText
				   </td>
				   </tr>
				   <tr>
				   <td colspan='2' style='padding-left:20px;'>
				   <iframe width='700' height='400' src='$linkText?autoplay=1&mute=1'></iframe>
				   </td>
				   </tr>
				   </table>
				   </div>
				   </form>";
		}
	}
	
	if (isset($_POST['prenota']) ){


					$xmlString2 = "";
						foreach ( file("./fileXML/moviesPrenotati$idUser.xml") as $node ) {
								$xmlString2 .= trim($node);
						}

						$docFilmPrenotati = new DOMDocument();
						
						if (!$docFilmPrenotati->loadXML($xmlString2)) {
							  die ("ERRORE nel parsing di moviesprenotati.xml\n");
							}
							
					$docFilmPrenotati->formatOutput = true;
					
					if (is_null($docFilmPrenotati->documentElement->childNodes)){
						/*Qui gestisco l'aggiunta del film al file moviesprenotati.xml
						nel caso in cui non ci siano ancora altri film nel file*/
						
						$root = $docFilmPrenotati->createElement('moviesPrenotati');
							
						$newFilm = $docFilmPrenotati->createElement("film");
						$newId = $docFilmPrenotati->createElement("id", "$idPrenot");
						$newTitolo = $docFilmPrenotati->createElement("titolo", "$titoloPrenot");
						$newDurata = $docFilmPrenotati->createElement("durata", "$durataPrenot");
						$newTrama = $docFilmPrenotati->createElement("trama", "$tramaPrenot");
						$newAnno = $docFilmPrenotati->createElement("anno", "$annoPrenot");
						$newLink = $docFilmPrenotati->createElement("link", "$linkPrenot");
						$newFilm->appendChild($newId);
						$newFilm->appendChild($newTitolo);
						$newFilm->appendChild($newDurata);
						$newFilm->appendChild($newTrama);
						$newFilm->appendChild($newAnno);
						$newFilm->appendChild($newLink);
							
						$root->appendChild($newFilm);
						$docFilmPrenotati->appendChild($root);
							
				
						}
					else{
						/*Qui invece gestisco l'aggiunta del film nel caso in cui
						ne siano già presenti altri e lo inserisco come primo elemento*/
						
						$root = $docFilmPrenotati->documentElement;
						
						$newFilm = $docFilmPrenotati->createElement("film");
						$newId = $docFilmPrenotati->createElement("id", "$idPrenot");
						$newTitolo = $docFilmPrenotati->createElement("titolo", "$titoloPrenot");
						$newDurata = $docFilmPrenotati->createElement("durata", "$durataPrenot");
						$newTrama = $docFilmPrenotati->createElement("trama", "$tramaPrenot");
						$newAnno = $docFilmPrenotati->createElement("anno", "$annoPrenot");
						$newLink = $docFilmPrenotati->createElement("link", "$linkPrenot");
						$newFilm->appendChild($newId);
						$newFilm->appendChild($newTitolo);
						$newFilm->appendChild($newAnno);
						$newFilm->appendChild($newDurata);
						$newFilm->appendChild($newTrama);
						$newFilm->appendChild($newLink);
							
						$filmPrenot=$docFilmPrenotati->documentElement->childNodes;
						$primo = $filmPrenot->item(0);
						$root->insertBefore($newFilm,$primo);
					
					}
				
					$docFilmPrenotati->save("./fileXML/moviesPrenotati$idUser.xml");
					
					print "<div style='justify-content:center;border:2px solid red;margin-top:10px;border-radius:15px;height:35%;width:80%;background-size:100%;background-color:red;'>
						   <h3 style='font-family:Heroes Assemble, sans serif;font-size:30px;color:white;'>Film prenotato con successo!</h3>
						   </div>";
					
			}   
?>
</body>
</html>