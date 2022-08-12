<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        $valueArray = array(
            'email'         => parseEmail($_POST["email"]),
            'nameCompany'   => $_POST['nameCompany'],
            'token'         => CreateToken(10),
            'nLicences'     => 1,
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
    <div>

        <?php echo render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'richiesta software demo')); ?>

        <main>

            <p>
                <b>Per ricevere il programma di calcolo inserisci di seguito i dati richiesti.</b>
            </p>
            <p>
                <b>Ti verrà inviato per e-mail il link da cui poter scaricare il programma.</b>
            </p>

            <form action="" method="post">
                <label for="nameCompany">Ragione sociale:</label>
                <input name="nameCompany" id="nameCompany" type="text" required="required" placeholder="Es. Confedilizia Como">

                <label for="email">Email agenzia/associazione:</label>
                <input name="email" id="email" type="email" required="required" placeholder="Es. <?php echo EMAIL['CONFEDILIZIA'] ?>">
                <input name="submit" id="submit" type="submit" value="Invia">
            </form>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>