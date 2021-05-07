<?php 
include "conn.php";     

$sql="CREATE TABLE IF NOT EXISTS Visite_sito (
		id int(4) NOT NULL AUTO_INCREMENT, 
		PRIMARY KEY (id),
        Data_salvataggio DATETIME DEFAULT CURRENT_TIMESTAMP,
		Indice_controllo int DEFAULT '0',
        Tabella_tutti_utenti int DEFAULT '0',
        Tabella_controllo_licenze int DEFAULT '0',        
        Scelta_programma int DEFAULT '0',
        Richiesta_demo int DEFAULT '0',
        Richiesta_illimitata int DEFAULT '0',
        Download_demo int DEFAULT '0',
        Download_illimitata int DEFAULT '0',
        Vendite int NULL,
        Somma_visite int NULL,
        Percentuale_incremento int NULL)"; 

if(!$connessione->query($sql))
	{
		echo "Errore della query: " . $connessione->error . "."; 
    }

$connessione->close();
?>