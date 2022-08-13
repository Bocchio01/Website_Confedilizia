<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        $valueArray = array(
            'email'         => parseEmail($_POST["email"]),
            'nameCompany'   => $_POST['nameCompany'],
            'codeUnivocal'  => $_POST["codeUnivocal"],
            'codeVAT'       => $_POST["codeVAT"],
            'address'       => $_POST["address"],
            'phone'         => $_POST['phone'],
            'token'         => CreateToken(10),
            'nLicences'     => $_POST['nLicences'],
            'swPrice'       => number_format($swPrice * $_POST["nLicences"], 2, '.', ''),
            'swPriceVAT'    => number_format($swPriceVAT * $_POST["nLicences"], 2, '.', ''),
        );

        $mailArray = array(
            'email'   => $valueArray['email'],
            'subject' => $subject,
            'msg'     => render('./template/email/richiestaIllimitata#noDemo.php', $valueArray),
            'headers' => $headers
        );

        $mailArrayConfedilizia = array(
            'email'   => EMAIL['CONFEDILIZIA'],
            'subject' => 'Dati fatturazione',
            'msg'     => render('./template/email/richiestaIllimitata#Confedilizia.php', $valueArray),
            'headers' => $headers
        );


        addUser($valueArray);
        updateUser($valueArray);
        addOrder("Illimitata", getUserId($valueArray['email']), $valueArray);

        sendEmail($mailArray);
        sendEmail($mailArrayConfedilizia);

        alert();
    } catch (Exception $e) {
        alert($e->getMessage());
    }
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Richiesta per versione illimitata'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'richiesta software illimitato')); ?>

        <main>

            <p>
                <b>Il costo della licenza illimitata è di € <?php echo $swPrice; ?> oltre IVA caduna da versare a Confedilizia Como.</b>
            </p>
            <p>
                N.B. Ogni software è utilizzabile solo su un determinato PC.<br>
                Se per esempio hai bisogno di avere il software installato su 3 PC dovrai comprare N. 3 licenze.
            </p>
            <p>
                Ti preghiamo di inviarci le informazioni richieste e di procedere al pagamento.
            </p>

            <h3 style="text-align: left;">- Dati anagrafici</h3>
            <form action="" method="post" style="width: 90%;">

                <div class="flex" style="row-gap: 0px">
                    <div>
                        <label for="nameCompany">Ragione sociale:</label>
                        <input name="nameCompany" id="nameCompany" type="text" required="required" placeholder="Es. A.P.E. - COMO">

                        <label for="codeVAT">Partita IVA:</label>
                        <input name="codeVAT" id="codeVAT" type="text" required="required" placeholder="Es. ...">

                        <label for="address">Indirizzo agenzia/associazione:</label>
                        <input name="address" id="address" type="text" required="required" placeholder="Es. Via Diaz 91 - 22100 Como">
                    </div>

                    <div>
                        <label for="codeUnivocal">Codice univoco:</label>
                        <input name="codeUnivocal" id="codeUnivocal" type="text" required="required" placeholder="Es. M5UXCR1">

                        <label for="email">Email agenzia/associazione:</label>
                        <input name="email" id="email" type="email" required="required" placeholder="Es. info@condefiliziacomo.it">

                        <label for="phone">Recapito telefonico:</label>
                        <input name="phone" id="phone" type="tel" required="required" placeholder="Es. 031271900">
                    </div>
                </div>

                <label for="nLicences">Quante licenze vuoi acquistare?</label>
                <div class="flex" style="row-gap: 0px">
                    <select name="nLicences" id="nLicences" onchange="updatePrice()" style="width: 100px; flex-grow: 0">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label>Equivalenti a: € <span id="swPrice"><?php echo $swPrice; ?></span> oltre IVA - € <span id="swPriceVAT1"><?php echo $swPriceVAT; ?></span> IVA inclusa</label>
                </div>

                <input name="submit" id="sumbit" type="submit" value="Invia dati">
            </form>

            <h3 style="text-align: left;">- Estremi bancari</h3>
            <ul style="font-weight: bold;">
                <li>Banca di riferimento: <?php echo BANK_DATA['NAME'] ?></li>
                <li>IBAN: <?php echo BANK_DATA['IBAN'] ?></li>
                <li>Causale: <?php echo BANK_DATA['CAUSAL'] ?></li>
                <li>Somma da versare: € <span id="swPriceVAT2"><?php echo $swPriceVAT; ?></span> IVA inclusa</li>
            </ul>

            <br>
            <p style="text-align:center; margin-bottom: 0px;">
                In caso di problemi legati al pagamento contattare <a href="mailto:<?php echo EMAIL['CONFEDILIZIA'] ?>" style="color: black;"><b><?php echo EMAIL['CONFEDILIZIA'] ?></b></a>
            </p>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

<script>
    function updatePrice() {
        const nLicences = document.getElementById("nLicences").value;
        document.getElementById("swPrice").innerHTML = (<?php echo $swPrice; ?> * nLicences).toFixed(2);
        document.getElementById("swPriceVAT1").innerHTML = (<?php echo $swPriceVAT; ?> * nLicences).toFixed(2);
        document.getElementById("swPriceVAT2").innerHTML = (<?php echo $swPriceVAT; ?> * nLicences).toFixed(2);
    }
</script>

</html>