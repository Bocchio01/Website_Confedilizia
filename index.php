<?php

include_once "./_settings.php";
updateInteractions();

if (
	(isset($_COOKIE['tokenAdmin']) && $_COOKIE['tokenAdmin'] == API_KEY)
	|| (isset($_POST['api_key']) &&  $_POST['api_key'] == API_KEY)
	|| (isset($_GET['api_key']) &&  $_GET['api_key'] == API_KEY)
) {
	Cookie(API_KEY);
	header("Location: ./Indice_controllo.php");
	exit();
}

header("Location: ./Scelta_programma.php");
exit();
