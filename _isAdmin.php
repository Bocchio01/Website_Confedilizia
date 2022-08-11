<?php

include "./_settings.php";
$login = FALSE;

if (
    (isset($_COOKIE['tokenAdmin']) && $_COOKIE['tokenAdmin'] == API_KEY)
    || (isset($_POST['api_key']) &&  $_POST['api_key'] == API_KEY)
    || (isset($_GET['api_key']) &&  $_GET['api_key'] == API_KEY)
) {
    $login = TRUE;
    Cookie(API_KEY);
}


if ($login === FALSE) {
    ClearCookie();
    try {
        logError("Login non riuscito", print_r($_SERVER, true));
    } catch (\Throwable $th) {
    }
    alert("Login error!");
    die(render("./template/site/login.php", array(
        'fromURL' => $_SERVER['REQUEST_URI'],
    )));
}
