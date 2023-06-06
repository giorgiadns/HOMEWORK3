<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Creazione db e popolamento</title>
</head>

<body>
	<h1>Creazione e popolamento del database "Film"</h1>
	
<?php 

error_reporting(E_ALL &~E_NOTICE);

//DATI DB
$db_name="film"; 
$tab_user="user";

//CONNESSIONE

//Connessione al db (con lo stesso utente degli esempi per semplicità)
$mysqliConn=new mysqli("localhost","archer","archer");

//Controllo della connessione
if (mysqli_connect_errno()){
	printf("Impossibile connettersi al database\n");
	exit();
}


//CREAZIONE DEL DB
$queryCreateDB="CREATE DATABASE $db_name";
$result=mysqli_query($mysqliConn, $queryCreateDB);
if($result) {
	printf("Database %s creato\n",$db_name);
	echo "<hr />";
}
else {	
	printf("Impossibile creare il database %s\n",$db_name);
	exit();
	
}

//Chiusura della connessione
mysqli_close($mysqliConn);

//Riapertura della connessione
$mysqliConn=mysqli_connect("localhost","archer","archer",$db_name);

//Controllo della connessione
if (mysqli_connect_errno()){
	printf("Impossibile connettersi al database %s\n",$db_name);
	exit();
}

//CREAZIONE TABELLA UTENTE
$queryCreateTable="CREATE TABLE IF NOT EXISTS $tab_user
			   (id INT NOT NULL AUTO_INCREMENT,
			   username VARCHAR (30) NOT NULL,
			   password VARCHAR (32) NOT NULL,
			   nome CHAR (32) NOT NULL,
			   cognome CHAR (32) NOT NULL,
			   PRIMARY KEY (id));";
			   
echo "<p>$queryCreateTable</p>";

//Controllo esito queryCreateTable
if($result=mysqli_query($mysqliConn,$queryCreateTable)){
	printf("OK, tabella user creata correttamente!\n");
	echo "<hr />";
}
else{
	printf("ERRORE, la tabella user non è stata creata\n");
	exit();
}

//POPOLAMENTO DEL DB

//POPOLAMENTO TABELLA USER
$queryInsert="INSERT INTO user (username, password, nome, cognome) VALUES
			 ('giorgiadns','giorgiadns','Giorgia','De Nardis'),
			 ('marcotemperini','marcotemperini','Marco','Temperini');";
			 
//Controllo esito queryInsert
if($result=mysqli_query($mysqliConn,$queryInsert)){
	echo "<p>OK, tabella user popolata correttamente!</p>";
	echo "<table border='1'>
		  <tr>
		  <th>ID</td>
		  <th>Username</th>
          <th>Password</th> 
		   <th>Nome</th> 
		   <th>Cognome</th> 
          </tr>";
	$querySelect="SELECT * FROM $tab_user;";
	$resultSel=mysqli_query($mysqliConn,$querySelect);
	while ($row=mysqli_fetch_assoc($resultSel)){
	echo "<tr> \n";
	echo "<td>" .$row["id"]. "</td> \n";
	echo "<td>" .$row["username"] . "</td> \n";
	echo "<td>" .$row["password"] . "</td> \n";
	echo "<td>" .$row["nome"] . "</td> \n";
	echo "<td>" .$row["cognome"] . "</td> \n";
	echo "</tr>";
	}
	echo "</table>";
	echo "<hr />";
}
else{
	printf("ERRORE, la tabella user non è stata popolata\n");
	exit();
}

//CHIUSURA CONNESSIONE

mysqli_close($mysqliConn);

?>

</body>
</html>