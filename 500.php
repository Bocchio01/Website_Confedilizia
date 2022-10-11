<?php

include_once "./_env.php";
include_once "./_functions.php";

?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Errore 500'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'errore 500')); ?>

        <main>

            <p>
                C'è stato un problema durante l'elaborazione della richiesta.<br>
                Ti preghiamo di riprovare più tardi.
            </p>
            <p>
                Ci scusiamo per il disagio.
            </p>


        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>