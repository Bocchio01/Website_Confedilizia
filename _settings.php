<?php

include_once "_env.php";
include_once "_functions.php";

// Variables
$return_obj = new stdClass();
$return_obj->Data = new stdClass();
$return_obj->Status = -1;
$return_obj->Log = array();

$swPrice = number_format(PRICE, 2, '.', '');
$swPriceVAT = number_format($swPrice * 1.22, 2, '.', '');

// MySQL variables
$nomehost = "localhost";
$nomeuser = "root";
$password = "";
$database = "my_attestazioniaffitti";

// Email variables
$subject  = "Software prospetto di calcolo";
$headers  = "From: " . EMAIL['CONFEDILIZIA'] . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Starting connection to MySQL database
$conn = new mysqli($nomehost, $nomeuser, $password, $database);
try {
    if ($conn->connect_error) {
        throw new Exception("Error while connecting to database: $conn->connect_error");
    }
} catch (Exception $e) {
    alert($e->getMessage());
    sendEmail(array(
        'email'   => EMAIL['MASTER'],
        'subject' => 'FatalError from Database',
        'msg'     => $e->getMessage(),
        'headers' => "From: no-reply." . EMAIL['MASTER']
    ));
}

$return_obj->Log[] = "Connection with MySQL database opened";
