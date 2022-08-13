<html>

<body>
    <p>
        Ciao, hai una nuova richiesta di licenza illimitata per il software prospetto di calcolo.<br>
        Ecco i dati del richiedente:
    </p>
    <ul>
        <li>Ragione sociale: <?php echo $nameCompany ?></li>
        <li>Partita IVA: <?php echo $codeVAT ?></li>
        <li>Codice univoco: <?php echo $codeUnivocal ?></li>
        <li>Indirizzo: <?php echo $address ?></li>
        <li>Ha richiesto N. <?php echo $nLicences ?> copie illimitate e dovra' quindi pagare <?php echo $swPrice ?>€ oltre IVA, o <?php echo $swPriceVAT ?>€ IVA inclusa.</li>
    </ul>
    <p>
        Se hai bisogno di scrivergli, questa è la sua e-mail: <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a><br>
        Ricordati che per attivare la licenza, dovrai andare <a href="<?php echo HOST_SITE ?>/Tabella_controllo_licenze.php?api_key=<?php echo API_KEY ?>">a questo sito</a>.<br>
        Mi raccomando, attivala solo se hai ricevuto il pagamento!
    </p>
    <p>
        Grazie e buona giornata,<br>
        Il WebMaster T.B.
    </p>

</body>

</html>