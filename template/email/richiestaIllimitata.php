<html>

<body>
    <p>
        Ciao, hai una nuova richiesta di licenza illimitata per il software prospetto di calcolo.<br>
        Ecco i dati del richiedente:
    </p>
    <ul>
        <li>Ragione sociale: <?php echo $ragioneSociale ?></li>
        <li>Partita IVA: <?php echo $IVA ?></li>
        <li>Codice univoco: <?php echo $codiceUnivoco ?></li>
        <li>Indirizzo: <?php echo $indirizzo ?></li>
        <li>Ha richiesto N. <?php echo $numeroLicenze ?> copie illimitate e dovra' quindi pagare <?php echo $costo ?>€ oltre IVA, o <?php echo $costo_iva ?>€ IVA inclusa.</li>
    </ul>
    <p>
        Se hai bisogno di scrivergli, questa è la sua e-mail: <a href="mailto:<?php echo $mail ?>"><?php echo $mail ?></a><br>
        Ricordati che per attivare la licenza, dovrai andare <a href="<?php echo UTILS_SITE ?>/Tabella_controllo_licenze.php">a questo sito</a><br>
        Mi raccomando, attivala solo se hai ricevuto il pagamento!
    </p>


</body>

</html>