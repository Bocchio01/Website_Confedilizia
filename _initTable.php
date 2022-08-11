<?php
include "_settings.php";

$sql = array();


$sql[] = "CREATE TABLE IF NOT EXISTS Utenti_prospetto (
    id               INT(4)               NOT NULL AUTO_INCREMENT, 
    dateRegistration TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    email            VARCHAR(127)         NOT NULL,
    nameCompany      VARCHAR(127)         NOT NULL,
    codeUnivocal     VARCHAR(127) DEFAULT NULL,
    codeVAT          VARCHAR(127) DEFAULT NULL,
    address          VARCHAR(255) DEFAULT NULL,
    phone            VARCHAR(127) DEFAULT NULL,

    PRIMARY KEY (id),
    UNIQUE (email))
    ENGINE=InnoDB";


$sql[] = "CREATE TABLE IF NOT EXISTS Visite_sito (
    id         INT(4)       NOT NULL AUTO_INCREMENT,
    pageName   VARCHAR(127) NOT NULL,
    lastAccess TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (pageName))
    ENGINE=InnoDB";


$sql[] = "CREATE TABLE IF NOT EXISTS Demo_data (
    id           INT(4)       NOT NULL AUTO_INCREMENT,
    idUser       INT(4)       NULL,
    dateRequest  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    token        VARCHAR(127) NOT NULL,
    nDownload    INT(4)       DEFAULT 0,
    nLicences    INT(4)       NOT NULL,
    dateDownload JSON         DEFAULT ('[]'),
    priceEach    FLOAT(5)     DEFAULT 100.00,
    hasPayed     INT(4)       DEFAULT 1,
    datePayment  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (idUser) REFERENCES Utenti_prospetto(id) ON DELETE SET NULL ON UPDATE CASCADE)
    ENGINE=InnoDB";


$sql[] = "CREATE TABLE IF NOT EXISTS Illimitata_data (
    id           INT(4)       NOT NULL AUTO_INCREMENT,
    idUser       INT(4)       NULL,
    dateRequest  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    token        VARCHAR(127) NOT NULL,
    nDownload    INT(4)       DEFAULT 0,
    nLicences    INT(4)       NOT NULL,
    dateDownload JSON         DEFAULT ('[]'),
    priceEach    FLOAT(5)     DEFAULT 100.00,
    hasPayed     INT(4)       DEFAULT 0,
    datePayment  TIMESTAMP    NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (idUser) REFERENCES Utenti_prospetto(id) ON DELETE SET NULL ON UPDATE CASCADE)
    ENGINE=InnoDB";



$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Indice_controllo')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Tabella_tutti_utenti')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Tabella_controllo_licenze')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Scelta_programma')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Richiesta_demo')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Richiesta_illimitata')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Download_demo')";
$sql[] = "INSERT INTO Visite_sito (pageName) VALUES ('Download_illimitata')";



try {
    foreach ($sql as $value) Query($value);
} catch (Exception $e) {
    alert($conn->error);
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
