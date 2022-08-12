<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        addDownload("Illimitata", $_POST['token']);
        fileDownload(FILE_DOWNLOAD['ILLIMITATO']);
    } catch (Exception $e) {
        alert($e->getMessage());
    }
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Download versione illimitata'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'download versione illimitata')); ?>

        <main>

            <p>
                <b>Inserisci qui il codice ricevuto per e-mail.</b>
            </p>
            <p>
                Salva il file sul tuo computer. Avrai cosi ottenuto il programma in versione illimitata.
            </p>

            <form action="" method="post">
                <label for="token">Inserisci il codice:</label>
                <input name="token" id="token" type="text" required="required" placeholder="Es. 2gHjk53JFt">
                <input name="submit" id="submit" type="submit" value="Scarica licenza">
            </form>

            <p>
                <b>ATTENZIONE:</b> come specificato in fase d'acquisto, il software è unico e potrà essere utilizzato solo su <b>un</b> computer.<br>
                Nel caso non volessi averlo sul PC dove stai lavorando, riapri questa pagina web dal PC desiderato e scaricalo da lì.
            </p>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>