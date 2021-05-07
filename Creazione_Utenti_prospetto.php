<?php 
include "conn.php";     

$sql="CREATE TABLE IF NOT EXISTS Utenti_prospetto (
		id int(4) NOT NULL AUTO_INCREMENT, 
		PRIMARY KEY (id),
		nome varchar(30) NOT NULL,
		email varchar (50) NOT NULL,
        c_univoco varchar (20) NULL,
        IVA varchar (100) NULL,
        indirizzo varchar (200) NOT NULL,
        telefono bigint NOT NULL,
        codice varchar (11) NOT NULL,
        controllo int (2) NOT NULL,
        data_ora DATETIME DEFAULT CURRENT_TIMESTAMP,
		codiceL varchar (11) NULL,
        controlloL int (2) NULL,
        N_licenze int (2) NULL,
        data_oraL DATETIME NULL)"; 

if(!$connessione->query($sql)) {
	echo "Errore della query: " . $connessione->error . "."; }

$connessione->close();
?>
