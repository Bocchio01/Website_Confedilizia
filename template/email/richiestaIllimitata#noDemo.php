<html>

<body>
    <p>
        Siamo lieti <?php echo $nameCompany ?> che tu abbia scelto la versione illimitata del nostro programma.<br>
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
        Grazie e buona giornata,<br>
        Confedilizia Como
    </p>

</body>

</html>