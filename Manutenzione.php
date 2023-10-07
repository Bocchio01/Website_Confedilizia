<?php

include_once "./_settings.php";
updateInteractions();


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Sito in manutenzione'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'sito in manutenzione')); ?>

        <main>

            <p>
                Il sito si trova attualmente in fase di manutenzione.<br>
                Ti preghiamo di riprovare più tardi.
            </p>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>