<?php
include_once "./_settings.php";

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
    pcSerialNumber   JSON         DEFAULT ('[]'),
    lastAccess       JSON         DEFAULT ('{}'),

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
    priceEach    FLOAT(5)     DEFAULT 0,
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


$sql[] = "CREATE TABLE IF NOT EXISTS Indici_prospetto (
    id         INT(4)   NOT NULL AUTO_INCREMENT,
    validFrom  DATE     NOT NULL,
    indexValue FLOAT(5) NOT NULL,

    PRIMARY KEY (id))
    ENGINE=InnoDB";



$sql[] = "INSERT INTO Visite_sito (pageName) VALUES
('Scelta_programma'),
('Richiesta_demo'),
('Richiesta_illimitata'),
('Download_demo'),
('Download_illimitata'),
('Indice_controllo'),
('licenseCheck'),
('database'),
('analytics'),
('emailSender'),
('403'),
('404')";


$sql[] = "INSERT INTO Indici_prospetto (validFrom, indexValue) VALUES
('2020-10-01', 5.00),
('2023-10-01', 10.00)";



try {
    foreach ($sql as $value) Query($value);
} catch (Exception $e) {
    alert($conn->error);
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
