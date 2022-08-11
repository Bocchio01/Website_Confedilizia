<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        $valueArray = array(
            'email'         => parseEmail($_POST["email"]),
            'nameCompany'   => $_POST['nameCompany'],
            'token'         => CreateToken(10),
            'nLicences' => 1,
        );

        $mailArray = array(
            'email'   => $valueArray['email'],
            'subject' => $subject,
            'msg'     => render('./template/email/richiestaDemo.php', $valueArray),
            'headers' => $headers
        );

        addUser($valueArray);
        addOrder("Demo", getUserId($valueArray['email']), $valueArray);

        sendEmail($mailArray);

        alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');
    } catch (Exception $e) {
        alert($e->getMessage());
    }
}

$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Richiesta per versione demo'), 1); ?>

<body>

    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo (render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'richiesta software demo'))); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td><b>Per ricevere il programma di calcolo inserisci di seguito i dati richiesti.</b></td>
                                    </tr>
                                    <tr>
                                        <td><br><b>Ti verrà inviato per e-mail il link da cui poter scaricare il programma.</b></td>
                                    </tr>
                                    <tr>
                                        <table align="center" width="82%">
                                            <tbody>
                                                <tr>
                                                    <form action="" method="post">
                                                        <td style="text-align: left;">
                                                            <ul>
                                                                <br>
                                                                <li><label style="padding-right:7em">Ragione sociale:</label>&nbsp;<input type="text" name="nameCompany" id="nameCompany" required="required" placeholder="Es. Confedilizia Como"></li>
                                                                <br>
                                                                <li><label style="padding-right:2em">Email agenzia/associazione:</label><input type="text" name="email" id="email" required="required" placeholder="Es. <?php echo EMAIL['CONFEDILIZIA'] ?>"></li>
                                                            </ul>
                                                        </td>
                                                        <td align="center"><input style="margin-top: 20px;" class="submit" type="submit" value=" Invia " name="submit"></td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="88%" align="center">

                                            <?php echo (render('./template/site/footer.php', array())); ?>

                                        </table>
                                        <hr color="black" width="88%">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>