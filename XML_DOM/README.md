HOMEWORK 3 - XML con DOM - DE NARDIS GIORGIA (1939804)
-----------------------------------------------------------------

REPOSITORY GITHUB: https://github.com/giorgiadns/HOMEWORK3

-----------------------------------------------------------------

IN COSA CONSISTE IL PROGETTO 

L'esercizio consiste in un sito dove è possibile prenotare i biglietti
per alcuni film della Marvel.
Il file install.php si occupa dell'installazione di un database "film"
molto semplice, solo per la gestione degli utenti.
Il file dove sono listati i film disponibili è movies.xml,
i film che vengono prenotati vengono invece scritti all'interno 
di un file moviesprenotati$idUser.xml, quindi ne sono presenti 
tanti quanti gli utenti (in questo caso 2).

OPERAZIONI UTENTE: gli utenti possono visualizzare la lista dei film
disponibili, accedere ad una scheda più dettagliata di ogni film (con
trama, trailer, anno, durata, ecc.), visualizzare tutte le prenotazioni 
effettuate, sia passate che relative alla sessione corrente.
La sezione "Coming soon" è una pagina in HTML dove viene presentato
il prossimo film in arrivo nelle sale.

----------------------------------------------------------------

ISTRUZIONI PER L'USO

Dalla pagina di login si raggiungono tutte le altre, passando con il
puntatore sui pulsanti presenti in login.php si possono reperire tutte
le informazioni per accedere al sistema (user, username, password, etc.). 
Seguono alcune note:

1. Installazione e popolamento del DB: se ne occupa il file install.php;

2. Connessione al database: il file per la connessione al db connect.php
   utilizza l'account "archer" con password "archer", come negli esempi
   proposti a lezione, per evitare la creazione di un altro account;

3. Gli user: il db viene popolato con un totale di 2 user.
   Nella pagina di login sono elencati username e password in un tooltip,
   ma li riporto anche qui in caso di problemi:
		   a) username:"marcotemperini" password:"marcotemperini"
		   b) username:"giorgiadns" password:"giorgiadns"
