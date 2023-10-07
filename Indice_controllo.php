<?php

include_once "./_settings.php";
updateInteractions();

include_once "./_isAdmin.php";


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Schema logico del sito', 'robots' => 'noindex'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Index: "Prospetto di calcolo"', 'subtitle' => 'schema logico sito')); ?>

        <main>
            <p>
                <b>Per visitare una specifica pagina della mappa, cliccare con il cursore/mouse sopra il corrispondente blocco colorato.</b>
            </p>
        </main>

        <div style="overflow: auto; text-align: center;">

            <img src="/assets/img/siteLogicalScheme.jpg" usemap="#image-map" loading="lazy">
            <map name="image-map">
                <area href="/emailSender.php" coords="114,48,300,92" shape="rect">
                <area href="/database.php" coords="114,112,300,156" shape="rect">
                <area href="/licenseCheck.php" coords="114,176,300,220" shape="rect">
                <area href="/analytics.php" coords="114,240,300,284" shape="rect">
                <area href="/updateIndices.php" coords="114,302,300,345" shape="rect">

                <area href="/Scelta_programma.php" coords="562,85,750,129" shape="rect">
                <area href="/Richiesta_demo.php" coords="400,167,585,214" shape="rect">
                <area href="/Richiesta_illimitata.php" coords="725,168,910,214" shape="rect">
                <area href="/Download_demo.php" coords="400,272,585,317" shape="rect">
                <area href="/Download_illimitata.php" coords="725,272,910,317" shape="rect">
                <area href="/pdfViewer.php" coords="562,345,750,390" shape="rect">
            </map>
        </div>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>