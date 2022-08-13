<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        addDownload("Demo", $_POST['token']);
        fileDownload(FILE_DOWNLOAD['DEMO']);
    } catch (Exception $e) {
        alert($e->getMessage());
    }
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Download versione demo'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'download versione demo')); ?>

        <main>

            <p>
                <b>Inserisci qui il codice che hai ricevuto per e-mail.</b>
            </p>
            <p>
                Ti ricordiamo che potrai scaricarlo solo una volta e che il software funzionerà per 7 giorni dal primo avvio.
            </p>

            <form action="" method="post">
                <label for="token">Inserisci il codice:</label>
                <input name="token" id="token" type="text" required="required" placeholder="Es. 2gHjk53JFt">
                <input name="submit" id="submit" type="submit" value="Scarica software">
            </form>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>