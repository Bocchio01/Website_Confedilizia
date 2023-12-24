<html>

<body>
    <p>
        Buongiorno <?php echo $nameCompany ?>,<br><br>
        Ti comunichiamo che abbiamo effettuato un aggiornamento software al programma 'Prospetto di calcolo'.<br>
        Per ottenere l'aggiornamento, clicca <a href="<?php echo HOST_SITE ?>/Download_illimitata.php">questo link</a> ed inserisci questo codice: <i><?php echo $token ?></i>.<br>
    </p>
    <p>
        L'aggiornamento contiene:
    </p>
    <ul>
        <li>Rivalutazione fasce prospetto in base all'indice ISTAT (come specificato nell'Accordo Territoriale del Comune di Como)</li>
    </ul>
    <p>
        Consigliamo fortemente di procede con l'aggiornamento, scaricando la nuova versione dal link sopra ed eliminando dal proprio dispositivo quella attualmente installata.
        Si specifica che l'aggiornamento è disponibile solamente per macchine Windows.
    </p>
    <p>
        In caso di problemi durante il download, si consiglia di seguire <a href="<?php echo HOST_SITE ?>/pdfViewer.php?pdf=guideInstallationSoftware">questa quida</a>.
    </p>
    <p>
        Grazie e buona giornata,<br>
        Confedilizia Como
    </p>
</body>

</html>