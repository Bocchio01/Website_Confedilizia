<html>

<body>
    <p>
        Siamo lieti <?php echo $nameCompany ?> che tu abbia scelto di passare alla versione illimitata del nostro programma.<br>
        Ti preghiamo dunque, nel caso non lo avessi ancora fatto, di procedere al pagamento di € <?php echo $swPrice ?> oltre IVA, avendo scelto di acquistare N. <?php echo $nLicences ?> copie.<br><br>

        Di seguito gli estremi bancari:
    </p>
    <ul>
        <li>Banca di riferimento: <?php echo BANK_DATA['NAME'] ?></li>
        <li>IBAN: <?php echo BANK_DATA['IBAN'] ?></li>
        <li>Causale: <?php echo BANK_DATA['CAUSAL'] ?></li>
        <li>Somma da versare: € <?php echo $swPriceVAT ?> (IVA inclusa)</li>
    </ul>
    <p>
        Se hai necessità di prorogare per altri 7 giorni il tuo programma provvisorio, scarica di nuovo la versione demo da <a href="<?php echo HOST_SITE ?>/Download_demo.php">questo link</a>.<br>
        Il tokenDemo con cui scaricare il software è il seguente: <i><?php echo $token ?></i>.<br><br>
        Grazie e buona giornata,<br>
        Confedilizia Como
    </p>

</body>

</html>