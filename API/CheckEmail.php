<?php

require_once "../_settings.php";


$userEmail = isset($_GET['userEmail']) ? $_GET['userEmail'] : "";
$result = Query("SELECT id FROM Utenti_prospetto WHERE email = '$userEmail'");

if ($result->num_rows > 0) {
    echo "true";
} else {
    echo "false";
}
