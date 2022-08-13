<?php

include_once "./_settings.php";
updateInteractions();

logError(array('Error 403: forbidden access', print_r($_SERVER, true)));


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Errore 403'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'errore 403')); ?>

        <main>

            <p>
                <b>Non hai i permessi necessari per accedere a questa risorsa!</b>
            </p>
            <p>
                <a href="/">Clicca qui</a> per tornare alla home page del sito.
            </p>


        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>