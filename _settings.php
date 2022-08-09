<?php

include_once "_env.php";
include_once "_functions.php";

// Variables
$return_obj = new stdClass();
$return_obj->Data = new stdClass();
$return_obj->Status = -1;
$return_obj->Log = array();

$costo = number_format(100, 2, '.', '');
$costo_iva = number_format($costo * 1.22, 2, '.', '');

// MySQL variables
$nomehost = "localhost";
$nomeuser = "root";
$password = "";
$database = "my_attestazioniaffitti";

// Email variables
$subject = "Software prospetto di calcolo";
$headers = "From: info@confediliziacomo.it\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Starting connection to MySQL database
$conn = new mysqli($nomehost, $nomeuser, $password, $database);

if ($conn->connect_error) die(returndata(1, $conn->connect_error));

$return_obj->Log[] = "Connection with MySQL database opened";
