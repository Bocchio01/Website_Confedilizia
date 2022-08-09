<html>

<body>
    <p>
        Siamo lieti <?php echo $ragioneSociale ?> che tu abbia scelto di passare alla versione illimitata del nostro programma.<br>
        Ti preghiamo dunque, nel caso non lo avessi ancora fatto, di procedere al pagamento di € <?php echo $costo ?> oltre IVA, avendo scelto di acquistare N. <?php echo $numeroLicenze ?> copie.<br><br>

        Di seguito gli estremi bancari:
    </p>
    <ul>
        <li>Banca di riferimento: Credito Valtellinese</li>
        <li>IBAN: IT38Q0521610901000000057790</li>
        <li>Causale: Licenza prospetto di calcolo</li>
        <li>Somma da versare: € <?php echo $costo_iva ?> (IVA inclusa)</li>
    </ul>
    <p>
        Se hai necessità di prorogare per altri 7 giorni il tuo programma provvisorio, scarica di nuovo la versione demo da <a href="<?php echo UTILS_SITE ?>/Download_demo.php">questo link</a>.<br>
        Il tokenDemo con cui scaricare il software è il seguente: <i><?php echo $codice_rand ?></i>.<br><br>
        Grazie e buona giornata,<br>
        Confedilizia Como
    </p>

</body>

</html>