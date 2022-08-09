<?php
include "_settings.php";

$sql = array();


$sql[] = "CREATE TABLE IF NOT EXISTS Utenti_prospetto (
    id INT(4) NOT NULL AUTO_INCREMENT, 
    ragioneSociale VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    codiceUnivoco VARCHAR(20) DEFAULT NULL,
    IVA VARCHAR(100) DEFAULT NULL,
    indirizzo VARCHAR(200) DEFAULT NULL,
    telefono VARCHAR(127) DEFAULT NULL,
    dateDemo DATETIME DEFAULT NULL,
    tokenDemo VARCHAR(127) DEFAULT NULL,
    downloadDemo INT(2) DEFAULT 0,
    dateIllimitato DATETIME DEFAULT NULL,
    tokenIllimitato VARCHAR(11) DEFAULT NULL,
    downloadIllimitato INT(2) DEFAULT NULL,
    numeroLicenze INT(2) DEFAULT NULL,

    PRIMARY KEY (id),
    UNIQUE (email))
    ENGINE=InnoDB";


$sql[] = "CREATE TABLE IF NOT EXISTS Visite_sito (
    id INT(4) NOT NULL AUTO_INCREMENT,
    namePage VARCHAR(127) NOT NULL,
    lastAccess TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (namePage))
    ENGINE=InnoDB";



$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Indice_controllo')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Tabella_tutti_utenti')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Tabella_controllo_licenze')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Scelta_programma')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Richiesta_demo')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Richiesta_illimitata')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Download_demo')";
$sql[] = "INSERT INTO Visite_sito (namePage) VALUES ('Download_illimitata')";



foreach ($sql as $value) Query($value);

$conn->close();
returndata(0, "Connection with MySQL database closed");
