<?php

include_once "./_settings.php";
updateInteractions();

include_once "./_isAdmin.php";


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Schema logico del sito'), 1); ?>

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
                <area href="/Indice_controllo.php" alt="Indice_controllo" title="Indice_controllo" coords="337,31,520,76" shape="rect">
                <area href="/Tabella_tutti_utenti.php" alt="Tabella_tutti_utenti" title="Tabella_tutti_utenti" coords="112,118,297,164" shape="rect">
                <area href="/Tabella_controllo_licenze.php" alt="Tabella_controllo_licenze" title="Tabella_controllo_licenze" coords="99,200,310,246" shape="rect">
                <area href="/Tabella_visite_sito.php" alt="Tabella_visite_sito" title="Tabella_visite_sito" coords="112,280,297,325" shape="rect">
                <area href="/Scelta_programma.php" alt="Scelta_programma" title="Scelta_programma" coords="560,118,744,162" shape="rect">
                <area href="/Richiesta_demo.php" alt="Richiesta_demo" title="Richiesta_demo" coords="400,202,583,247" shape="rect">
                <area href="/Richiesta_illimitata.php" alt="Richiesta_illimitata" title="Richiesta_illimitata" coords="719,202,904,247" shape="rect">
                <area href="/Download_demo.php" alt="Download_demo" title="Download_demo" coords="398,301,623,347" shape="rect">
                <area href="/Download_illimitata.php" alt="Download_illimitata" title="Download_illimitata" coords="681,302,903,347" shape="rect">
            </map>
        </div>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>