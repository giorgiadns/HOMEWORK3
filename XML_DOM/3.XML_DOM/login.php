<?php

error_reporting(E_ALL &~E_NOTICE);

//CONNESSIONE
require_once("./connect.php");

if(isset($_POST['invio'])){
	
	//CONTROLLO CHE I DATI INSERITI NON SIANO NULLI
	if(empty($_POST['username']) || empty($_POST['password'])){
	
		echo "<h3 style='color:red;'>Dati mancanti!</h3>";
	}
	else {
		//VERIFICO CHE L'UTENTE ESISTA NEL DB
		$querySel="SELECT * FROM $tab_user
				  WHERE username=\"{$_POST['username']}\"
				  AND password =\"{$_POST['password']}\"";
				  
		if(!$resultSel=mysqli_query($mysqliConn,$querySel)){
			printf("ERRORE, utente inesistente!\n");
			exit();
		}
		
		$row=mysqli_fetch_array($resultSel);
		
		if($row){
			
			session_start();
			$_SESSION['username']=$_POST['username'];
			$_SESSION['dataLogin']=time();
			$_SESSION['idUser']=$row['id'];
			$_SESSION['accessopermesso']=1000;
			header('Location: film.php');
			exit();
			
		}
		else {
			echo "<h3 style='color:red;'>Accesso negato!</h3>";
		}
	}
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

	<div style="filter: drop-shadow(0.6rem 0.6rem 0.6rem rgba(0,0,0));border-radius:15px;height:25%;width:50%;background-size:100%;background-color:white;text-align:center;">
	<img src="./immagini/marvel-logo.png" width="80%" height="270px" style="align:center;"/>
	</div>
	
	<div style="width:50%;padding:0px 0px 0px 0px;border-radius:15px;margin-top:20px;">
	<a href="#" class="tooltip" style="width:30%;">
	<button class="button" style="width:100%;border-right:2px solid red;border-top-left-radius:15px;border-bottom-left-radius:15px;font-family:Heroes Assemble, sans serif;">Operazioni possibili</button>
	<span class="tooltiptext" style="width:100%;">Una volta effettuato l'accesso è possibile:
	<table style="border:2px solid white;">
	<tr>
	<th style="border:2px solid white;">Operazione</th>
	<th style="border:2px solid white;">Descrizione</th>
	</tr>
	<tr>
	<td style="border:2px solid white;">Visualizzare la lista dei film</td>
	<td style="border:2px solid white;">&Egrave; possibile visualizzare la lista di tutti i film in programmazione</td>
	</tr>
	<tr>
	<td style="border:2px solid white;">Visualizzare i dettagli del film</td>
	<td style="border:2px solid white;">Cliccando su "Prenota il biglietto" si accede ad una pagina dove sono presenti tutti i dettagli riguardanti il film scelto, &egrave; un passaggio intermedio prima della prenotazione.</td>
	</tr>
	<tr>
	<td style="border:2px solid white;">Prenotare i film</td>
	<td style="border:2px solid white;">Cliccando su "Prenota il biglietto" nella pagina con la scheda del film, si prenota il film.</td>
	</tr>
	<tr>
	<td style="border:2px solid white;">Visualizzare le prenotazioni</td>
	<td style="border:2px solid white;">Nella sezione "Prenotazioni" &egrave; possibile visualizzare tutte le prenotazioni (dalla pi&ugrave; recente alla pi&ugrave; datata), sia relative alla sessione corrente che quelle precendeti.</td>
	</tr>
	<tr>
	<td style="border:2px solid white;">Controllare le prossime uscite</td>
	<td style="border:2px solid white;">Nella sezione "Coming soon" viene presentato il film che uscir&agrave; a breve.</td>
	</tr>
	</table>
	</span></a>
	<a href="#" class="tooltip" style="width:30%;">
	<button class="button" style="width:100%;border-right:2px solid red;font-family:Heroes Assemble, sans serif;;">Account</button>
	<span class="tooltiptext">Gli account per poter accedere sono due, entrambi con gli stessi privilegi e operazioni possibili:
	<table style="border:2px solid white;">
	<tr>
	<th style="border:2px solid white;">Username</th>
	<th style="border:2px solid white;">Password</th>
	</tr>
	<tr>
	<td style="border:2px solid white;">giorgiadns</td>
	<td style="border:2px solid white;">giorgiadns</td>
	</tr>
	<tr>
	<td style="border:2px solid white;">marcotemperini</td>
	<td style="border:2px solid white;">marcotemperini</td>
	</tr>
	</table>
	</span></a>
	<a href="#" class="tooltip" style="width:30%;">
	<button class="button" style="width:100%;border-right:2px solid red;border-top-right-radius:15px;border-bottom-right-radius:15px;font-family:Heroes Assemble, sans serif;">Chi siamo</button>
	<span class="tooltiptext">Giorgia De Nardis - 1939804</span></a>
	</div>
	
	
	<div  style="filter: drop-shadow(0.6rem 0.6rem 0.6rem rgba(0,0,0));margin-top:20px;width:33%;top:50%;border-radius:10px;background-color:white;border:3px solid red;align-items:center;text-align:center;">
			<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
			<h1 style="font-family:Heroes Assemble, sans serif;color:red;font-size:40px;">LOGIN</h1>
			<h3 style="font-family:Heroes Assemble, sans serif;color:red;">USERNAME: <input type="text" name="username" size="30" style="border-radius:15px;" /></h3>
			<h3 style="font-family:Heroes Assemble, sans serif;color:red;">Password: <input type="password" name="password" size="30" style="border-radius:15px;" /></h3>
			<input type="submit" name="invio" value="Accedi" class="button" style="background-color:red;color:white;border-radius:15px;">
			<input type="reset" name="reset" value="Reset" class="button"  style="background-color:red;color:white;border-radius:15px;">
			</form>
		
	</div>