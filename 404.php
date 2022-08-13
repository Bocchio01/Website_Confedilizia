<?php

include_once "./_settings.php";
updateInteractions();


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Errore 404'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'errore 404')); ?>

        <main>

            <p>
                La pagina che stavi cercando sembrerebbe non eistere...
            </p>
            <p>
                <a href="/">Clicca qui</a> per tornare alla home page del sito.
            </p>


        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>