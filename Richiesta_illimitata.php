<?php

include "_settings.php";
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
            'nLicences' => $_POST['nLicences'],
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
    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'richiesta software illimitato')); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td><b>Il costo della licenza illimitata è di € <?php echo $swPrice; ?> oltre IVA caduna da versare a Confedilizia Como.</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>N.B. Ogni software è utilizzabile solo su un determinato PC.
                                            <br>Se per esempio hai bisogno di avere il software installato su 3 PC dovrai comprare N. 3 copie.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br>Ti preghiamo di inviarci le informazioni richieste e di procedere al pagamento.</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><br><br>
                                            <h2 style="text-align: left;">- Dati anagrafici</h2>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="" method="post">
                                <table align="center" width="82%">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: left;">
                                                <ul>
                                                    <li><label>Ragione sociale:</label><input type="text" name="nameCompany" id="nameCompany" required="required" placeholder="Es. A.P.E. - COMO"></li><br>
                                                    <li><label>Partita IVA:</label><input type="text" name="codeVAT" id="codeVAT" required="required" placeholder="Es. ..."></li><br>
                                                    <li><label>address agenzia/associazione:</label><input type="text" name="address" id="address" required="required" placeholder="Es. Via Diaz 91 - 22100 Como"></li><br><br>
                                                    <li>
                                                        <label>Quante copie vuoi acquistare?&nbsp</label>
                                                        <select style="width:78px;" id="nLicences" name="nLicences" onchange="updatePrice()">
                                                            <option selected value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                        <p style="margin: 0px; display: inline-block;">-></p>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td style="text-align: left;">
                                                <ul>
                                                    <li><label>Codice univoco:</label><input type="text" name="codeUnivocal" id="codeUnivocal" required="required" placeholder="Es. M5UXCR1"></li><br>
                                                    <li><label>Email agenzia/associazione:</label><input type="text" name="email" id="email" required="required" placeholder="Es. info@condefiliziacomo.it"></li><br>
                                                    <li><label>Recapito telefonico:</label><input type="text" name="phone" id="phone" required="required" placeholder="Es. 031271900"></li><br><br>
                                                    <div id="prezzo" style="height:35px; position:relative; top:8px;">(€ <?php echo $swPrice; ?> oltre IVA - € <?php echo $swPriceVAT; ?> IVA inclusa)</div>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="center" width="88%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input style="margin-top:7px" class="submit" type="submit" value=" Invia dati " name="submit">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left">
                                                <br><br>
                                                <h2 style="text-align: left;">- Estremi bancari</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <table align="center" width="82%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <ul style="text-align: left;">
                                                <li><b>Banca di riferimento: <?php echo BANK_DATA['NAME'] ?></b></li><br>
                                                <li><b>IBAN: <?php echo BANK_DATA['IBAN'] ?></b></li><br>
                                                <li><b>Causale: <?php echo BANK_DATA['CAUSAL'] ?></b></li><br>
                                                <li><b id="dato_bancario">Somma da versare: € <?php echo $swPriceVAT; ?> IVA inclusa</b></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="center" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <br>In caso di problemi legati al pagamento contattare <a href="mailto:<?php echo EMAIL['CONFEDILIZIA'] ?>" class="intestazione_piccolo"><b><?php echo EMAIL['CONFEDILIZIA'] ?></b></a>
                                            <br>Per assistenza tecnica, contattare <a href="mailto:<?php echo EMAIL['MASTER'] ?>" class="intestazione_piccolo"><b><?php echo EMAIL['MASTER'] ?></b></a>
                                            <hr color="black" width="88%">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

<script>
    function updatePrice() {
        const nLicences = document.getElementById("nLicences").value;
        document.getElementById("prezzo").innerHTML = "(€ " + (<?php echo $swPrice; ?> * nLicences).toFixed(2) + " oltre IVA" + " - € " + (<?php echo $swPriceVAT; ?> * nLicences).toFixed(2) + " IVA inclusa)";
        document.getElementById("dato_bancario").innerHTML = "Somma da versare: € " + (<?php echo $swPriceVAT; ?> * nLicences).toFixed(2) + " IVA inclusa";
    }
</script>

</html>