<?php

include_once "./_settings.php";
updateInteractions();


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Software ConfediliziaComo'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'software ConfediliziaComo')); ?>

        <main>

            <div class="flex">
                <div>
                    <h3>Il software:</h3>
                    <ul>
                        <li>Permette di calcolare in maniera istantanea il <b>canone di locazione</b> per una specifica unità abitativa nel comune di Como. </li>
                        <li>La probabilità di commettere errori di calcolo si riduce a zero.</li>
                        <li>Possibilità di esportare il prospetto come documento PDF.</li>
                        <li>Possibilità di stampare il prospetto in maniera ordinata e chiara.</li>
                    </ul>
                    <p>
                        Se vuoi visualizzare un esempio di PDF stampabile generato automaticamente dal programma, clicca qui: <a href="/pdfViewer.php?pdf=examplePDF">Esempio PDF</a>.
                    </p>
                </div>
                <div style="text-align: center;">
                    <iframe src="/assets/img/exampleExcel.mp4" alt="Video demo del programma" title="Video demo del programma" height="350px" loading="lazy"></iframe>
                </div>
            </div>

            <h3>Ottieni il software:</h3>
            <ul>
                <li><a href="/Richiesta_demo.php">Versione demo (Gratuita):</a> consente un utilizzo del software completo per 7 giorni.</li>
                <li><a href="/Richiesta_illimitata.php">Versione illimitata (Costo: €.<?php echo $swPrice; ?> oltre IVA):</a> consente un utilizzo del software completo per una durata illimitata ed eventuale assistenza tecnica.</li>
            </ul>

            <p style="text-align: center;">
                Requisiti del sistema: Microsoft Excel 2010 o versioni successive<br>
                <b>Non compatibile</b> con: OpenOffice, dispositivi mobile (telefoni e/o tablet)
            </p>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>