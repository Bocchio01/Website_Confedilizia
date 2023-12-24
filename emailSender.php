<?php

include_once "./_settings.php";
require_once "./_isAdmin.php";

$logs = array();
if ($login && isset($_POST["submit"])) {

    switch ($_POST["userType"]) {
        case 'demo':
            // $data = Query("SELECT U.email as email, U.nameCompany as nameCompany, D.token as token FROM Utenti_prospetto as U JOIN Demo_data as D WHERE U.id = D.idUser AND D.nDownload = 0 GROUP BY U.email ORDER BY D.id");
            break;
        case 'illimitati':
            $data = Query("SELECT U.email as email, U.nameCompany as nameCompany, I.token as token FROM Utenti_prospetto as U JOIN Illimitata_data as I WHERE U.id = I.idUser AND I.nDownload = 0 GROUP BY U.email ORDER BY I.id");
            break;
        default:
            $logs[] = "Error";
            break;
    }

    while ($row = $data->fetch_array(MYSQLI_ASSOC)) {

        $valueArray = array(
            'nameCompany'   => $row['nameCompany'],
            'token'         => $row['token'],
        );

        $mailArray = array(
            'email'   => $row['email'],
            'subject' => $subject,
            'msg'     => render('./template/email/emailSender.php', $valueArray),
            'headers' => $headers
        );

        try {
            sendEmail($mailArray);
            $logs[] = 'ok:' . $mailArray['email'] . '<br>';
        } catch (Exception $e) {
            $logs[] = array('Status' => $e->getMessage(), 'Data' => $valueArray);
            logError(array($e->getMessage(), $valueArray));
        }
    }
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Email sender', 'robots' => 'noindex'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => '"Prospetto di calcolo"', 'subtitle' => 'email sender')); ?>

        <main>
            <p>
                Questa pagina ha la funzionalità di inviare email a tutti o a una parte selezionata degli utenti del programma.<br>
                Controlla il testo dell'email che verrà inviato e seleziona la tipologia di utenti a cui spedire l'email.
                Le parole <b>in grassetto</b> saranno automaticamente modificate con il dato corretto relativo al destinatario.<br>
                Ad operazione completata verrà mostrato sotto un log dell'operazione.
            </p>

            <h3 style="text-align:left">
                - Email:
            </h3>

            <div class="wrapper">
                <?php echo render(
                    './template/email/emailSender.php',
                    array(
                        'email'         => '<b>email</b>',
                        'nameCompany'   => '<b>nameCompany</b>',
                        'codeUnivocal'  => '<b>codeUnivocal</b>',
                        'codeVAT'       => '<b>codeVAT</b>',
                        'address'       => '<b>address</b>',
                        'phone'         => '<b>phone</b>',
                        'token'         => '<b>token</b>',
                        'nLicences'     => '<b>nLicences</b>',
                        'swPrice'       => '<b>swPrice</b>',
                        'swPriceVAT'    => '<b>swPriceVAT</b>',
                    )
                ) ?>
            </div>

            <br>

            <form action="" method="post">
                <label for="userType">Seleziona i destinatari:</label>
                <select name="userType" id="userType" required="required">
                    <option value=""></option>
                    <option value="demo">Utenti demo</option>
                    <option value="illimitati" selected>Utenti illimitati</option>
                </select>
                <input name="submit" id="submit" type="submit" value="Invia l'email">
            </form>

            <?php if (!empty($logs)) : ?>
                <h3 style="text-align:left">
                    - Logs:
                </h3>

                <pre class="wrapper" style="white-space: pre-wrap;">
                <?php foreach ($logs as $log) {
                    print_r($log);
                } ?>
            </pre>
            <?php endif ?>
        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>