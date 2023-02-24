<?php

function returndata(int $code = 0, string $log = null): void
{
    global $return_obj;
    $return_obj->Log[] = $log;
    $return_obj->Status = $code;
    if (IS_DEV) {
        echo "<script>console.log(" . json_encode($return_obj) . ")</script>";
    }
}


function Query(string $sql)
{
    global $conn, $return_obj;
    if (!$result = $conn->query($sql)) {

        logError(array($sql, $conn->error));

        $return_obj->Log[] = $conn->error;
        $return_obj->Status = 1;

        throw new Exception("Errore durante l'elaborazione della richiesta. Riprovare più tardi...");
    }

    return $result;
}


function CreateToken(int $lenght = 15): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < $lenght; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $token;
}


function render(string $script, array $vars = array(), bool $loadStyle = FALSE)
{
    extract($vars);

    if ($loadStyle) {
        $style = file_get_contents('./assets/style.css',);
    }

    ob_start();
    include $script;
    return ob_get_clean();
}


function Cookie(string $cookie_value)
{
    return setcookie('tokenAdmin', "$cookie_value", [
        'expires'  => time() + 60 * 60 * 24 * 30,
        'path'     => '/',
        'samesite' => 'None',
        'secure'   => 'Secure',
        'httponly' => false,
    ]);
}


function ClearCookie()
{
    return setcookie('tokenAdmin', '', [
        'path'     => '/',
        'samesite' => 'None',
        'secure'   => 'Secure',
        'httponly' => true,
    ]);
}


function updateInteractions(): bool
{
    $pageName = basename($_SERVER['REQUEST_URI'], ".php");
    $year = date("Y");
    $month = (int) date("m") - 1;

    if (Query("SHOW COLUMNS FROM Visite_sito LIKE '$year'")->num_rows == 0) {
        Query("ALTER TABLE Visite_sito ADD COLUMN `$year` JSON DEFAULT ('[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]')");
    }

    if (isset($_COOKIE['tokenAdmin']) && $_COOKIE['tokenAdmin'] == API_KEY) return FALSE;
    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) return FALSE;
    if (Query("SELECT * FROM Visite_sito WHERE pageName = '$pageName' LIMIT 1")->num_rows == 0) return FALSE;

    Query("UPDATE Visite_sito SET `$year` = JSON_SET(`$year`, '$[$month]', CAST(JSON_EXTRACT(`$year`, '$[$month]') + 1 AS unsigned)) WHERE pageName = '$pageName'");

    return TRUE;
}


function logError(array $args): void
{
    error_log(
        $logMsg = implode("\n", array(date(DATE_RSS), print_r(get_defined_vars(), true) . "\n\n\n")),
        3,
        './.log'
    );

    sendEmail(array(
        'email'   => EMAIL['MASTER'],
        'subject' => "Errore durante l'elaborazione di una Query",
        'msg'     => implode("\n", array(date(DATE_RSS), $_SERVER['REQUEST_URI'])),
        'headers' => "From: " . EMAIL['MASTER'],
    ));
}


function parseEmail(string $email): string
{
    $emailLower = strtolower($email);
    if (!filter_var($emailLower, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Formato email non corretto.');
    }

    return $emailLower;
}


function sendEmail(array $args, bool $throwException = TRUE): bool
{
    if (
        $throwException
        && !strpos(HOST_SITE, 'localhost')
        && !mail($args['email'], $args['subject'], $args['msg'], $args['headers'])
    ) {
        throw new Exception("Errore durante l'invio della email. Riprovare più tardi...");
    }

    return TRUE;
}


function getUserId(string $email): int
{
    return (int) Query("SELECT id FROM Utenti_prospetto WHERE email = '$email'")->fetch_array(MYSQLI_ASSOC)['id'];
}


function addUser(array $args): bool
{
    if (getUserId($args['email'])) return FALSE;

    Query("INSERT INTO Utenti_prospetto (
            nameCompany,
            email
        ) VALUES (
            '$args[nameCompany]',
            '$args[email]'
        )");

    return TRUE;
}


function updateUser(array $args)
{
    if (Query("SELECT id FROM Utenti_prospetto WHERE email = '$args[email]'")->num_rows == 0) {
        throw new Exception("L'utente non esiste.");
    }

    Query("UPDATE Utenti_prospetto SET
            nameCompany  = '$args[nameCompany]',
            codeUnivocal = '$args[codeUnivocal]',
            codeVAT      = '$args[codeVAT]',
            phone        = '$args[phone]',
            address      = '$args[address]'
        WHERE email = '$args[email]'");

    return TRUE;
}


function addOrder(string $orderType, int $idUser, $args, $priceEach = PRICE)
{
    switch ($orderType) {

        case "Demo":
            if (Query("SELECT id FROM Demo_data WHERE idUser = $idUser")->num_rows > 0) {
                throw new Exception("Hai già ordinato la versione demo.");
            }
            if (Query("SELECT id FROM Illimitata_data WHERE idUser = $idUser")->num_rows > 0) {
                throw new Exception("Non puoi ordinare la versione demo avendo già fatto richiesta della versione illimitata.");
            }

            Query("INSERT INTO Demo_data (
                idUser,
                token,
                nLicences,
                priceEach
            ) VALUES (
                $idUser,
                '$args[token]',
                $args[nLicences],
                $priceEach
            )");
            break;

        case "Illimitata":
            if (Query("SELECT id FROM Illimitata_data WHERE idUser = $idUser AND hasPayed = 0")->num_rows > 0) {
                throw new Exception("Paga il precedente ordine prima di procedere.");
            }

            Query("INSERT INTO Illimitata_data (
                idUser,
                token,
                nLicences,
                priceEach
            ) VALUES (
                $idUser,
                '$args[token]',
                $args[nLicences],
                $priceEach
            )");
            break;
    }

    return TRUE;
}


function addDownload(string $orderType, string $token): bool
{
    $token = trim(str_replace('.', '', $token));
    switch ($orderType) {

        case "Demo":
            $row = Query("SELECT * FROM Demo_data WHERE token = '$token' LIMIT 1")->fetch_array(MYSQLI_ASSOC);

            if (empty($row)) {
                throw new Exception("Il codice inserito è sbagliato!");
            }
            if ($row['nDownload'] >= $row['nLicences']) {
                throw new Exception("Ha già scaricato il software versione demo!");
            }

            $mysqltime = date("Y-m-d H:i:s");
            Query("UPDATE Demo_data SET
                    nDownload    = nDownload + 1,
                    dateDownload = JSON_ARRAY_APPEND(dateDownload, '$', '$mysqltime')
                WHERE id = $row[id]");
            break;

        case "Illimitata":
            $row = Query("SELECT * FROM Illimitata_data WHERE token = '$token' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
            if (empty($row)) {
                throw new Exception("Il codice inserito è sbagliato!");
            }
            if ($row['hasPayed'] == 0) {
                throw new Exception("Non risulta ancora alcun pagamento effettuato!");
            }
            if ($row['nDownload'] >= $row['nLicences']) {
                throw new Exception("Ha già scaricato tutte le licenze!");
            }

            $mysqltime = date("Y-m-d H:i:s");
            Query("UPDATE Illimitata_data SET
                    nDownload    = nDownload + 1,
                    dateDownload = JSON_ARRAY_APPEND(dateDownload, '$', '$mysqltime')
                WHERE id = $row[id]");
            break;
    }

    return TRUE;
}

function setPayment($id): bool
{
    $row = Query("SELECT * FROM Illimitata_data WHERE id = $id AND hasPayed <> 1 LIMIT 1")->fetch_array(MYSQLI_ASSOC);
    if (empty($row)) {
        throw new Exception("Qualcosa è andato storto! Riprova o contatta il WebMaster T.B.");
    }

    Query("UPDATE Illimitata_data SET hasPayed = 1, datePayment = NOW() WHERE id = $id AND hasPayed <> 1");

    return TRUE;
}


function fileDownload($file)
{
    if (IS_DEV) {
        alert($file);
        return TRUE;
    }

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

function alert(string $msg = 'Richiesta effettuata con successo! Controlla la tua casella e-mail'): void
{
    if (IS_DEV) {
        echo "<script type = 'text/javascript'>console.log(`$msg`);</script>";
    } else {
        echo "<script type = 'text/javascript'>alert(`$msg`);</script>";
    }
}

function fileExists($url)
{
    $headers = @get_headers($url);
    if (!$headers) return false;
    return strpos($headers[0], '200 OK') !== false;
}
