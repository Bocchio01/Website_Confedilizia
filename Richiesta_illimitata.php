<?php

include "_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    $costo =  number_format($costo * $_POST["numeroLicenze"], 2, '.', '');
    $costo_IVA = number_format($costo_iva * $_POST["numeroLicenze"], 2, '.', '');

    $email = strtolower($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) echo "<script type = 'text/javascript'>alert('Formato e-mail non corretto.');</script>";
    else {
        $msgConfedilizia = render(
            './template/email/richiestaIllimitata.php',
            array(
                'ragioneSociale' => $_POST['ragioneSociale'],
                'IVA'            => $_POST["IVA"],
                'codiceUnivoco'  => $_POST["codiceUnivoco"],
                'indirizzo'      => $_POST["indirizzo"],
                'numeroLicenze'  => $_POST['numeroLicenze'],
                'costo'          => $costo,
                'costo_iva'      => $costo_IVA,
                'mail'           => $email,
            )
        );

        $codice_rand = CreateToken(10);
        $result = Query("SELECT * FROM Utenti_prospetto WHERE email = '$email' LIMIT 1");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $case = 1;
            if ($row["telefono"] != NULL) {
                if ($row["tokenIllimitato"] != NULL) $case = 3;
                else $case = 2;
            }
        } else $case = 0;

        switch ($case) {
            case 0:
                Query("INSERT INTO Utenti_prospetto (
                    ragioneSociale,
                    email,
                    codiceUnivoco,
                    IVA,
                    indirizzo,
                    telefono,
                    downloadDemo,
                    downloadIllimitato,
                    numeroLicenze,
                    dateIllimitato
                ) VALUES (
                    '$_POST[ragioneSociale]',
                    '$email',
                    '$_POST[codiceUnivoco]',
                    '$_POST[IVA]',
                    '$_POST[indirizzo]',
                    '$_POST[telefono]',
                    0,
                    0,
                    $_POST[numeroLicenze],
                    now()
                )");

                echo "<script type = 'text/javascript'>alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');</script>";

                $msg = render(
                    './template/email/richiestaIllimitata#0.php',
                    array(
                        'ragioneSociale' => $_POST['ragioneSociale'],
                        'numeroLicenze'  => $_POST['numeroLicenze'],
                        'costo'          => $costo,
                        'costo_iva'      => $costo_IVA
                    )
                );

                mail($email, $subject, $msg, $headers);
                mail('info@confediliziacomo.it', 'Dati fatturazione', $msgConfedilizia, $headers);
                break;

            case 1:
                Query("UPDATE Utenti_prospetto SET
                    ragioneSociale     = '$_POST[ragioneSociale]',
                    codiceUnivoco      = '$_POST[codiceUnivoco]',
                    IVA                = '$_POST[IVA]',
                    tokenDemo          = '$codice_rand',
                    telefono           = '$_POST[telefono]',
                    indirizzo          = '$_POST[indirizzo]',
                    downloadIllimitato = 0,
                    downloadDemo       = 0,
                    numeroLicenze      = $_POST[numeroLicenze],
                    dateIllimitato     = now() 
                WHERE email = '$email'");

                echo "<script type = 'text/javascript'>alert('Richiesta effettuata con successo. Controlla la tua casella e-mail');</script>";

                $msg = render(
                    './template/email/richiestaIllimitata#1.php',
                    array(
                        'ragioneSociale' => $_POST['ragioneSociale'],
                        'numeroLicenze'  => $_POST['numeroLicenze'],
                        'costo'          => $costo,
                        'costo_iva'      => $costo_IVA,
                        'codice_rand'    => $codice_rand,
                    )
                );

                mail($email, $subject, $msg, $headers);
                mail('info@confediliziacomo.it', 'Dati fatturazione', $msgConfedilizia, $headers);
                break;

            case 2:
                echo "<script type = 'text/javascript'>alert('Paga il precedente ordine per acquistare ulteriori licenze!');</script>";
                break;

            case 3:
                Query("UPDATE Utenti_prospetto SET 
                    ragioneSociale  = '$_POST[ragioneSociale]',
                    codiceUnivoco   = '$_POST[codiceUnivoco]',
                    IVA             = '$_POST[IVA]',
                    telefono        = '$_POST[telefono]',
                    indirizzo       = '$_POST[indirizzo]',
                    tokenIllimitato = NULL,
                    numeroLicenze   = numeroLicenze + $_POST[numeroLicenze],
                    dateIllimitato  = now()
                WHERE email = '$email'");

                echo "<script type = 'text/javascript'>alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');</script>";

                $msg = render(
                    './template/email/richiestaIllimitata#0.php',
                    array(
                        'ragioneSociale' => $_POST['ragioneSociale'],
                        'numeroLicenze'  => $_POST['numeroLicenze'],
                        'costo'          => $costo,
                        'costo_iva'      => $costo_IVA,
                    )
                );

                mail($email, $subject, $msg, $headers);
                mail('info@confediliziacomo.it', 'Dati fatturazione', $msgConfedilizia, $headers);
                break;
        }
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

                <?php echo (render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'richiesta software illimitato'))); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td><b>Il costo della licenza illimitata è di € <?php echo $costo; ?> oltre IVA caduna da versare a Confedilizia Como.</b></td>
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
                                                    <li><label>Ragione sociale:</label><input type="text" name="ragioneSociale" id="ragioneSociale" required="required" placeholder="Es. A.P.E. - COMO"></li><br>
                                                    <li><label>Partita IVA:</label><input type="text" name="IVA" id="IVA" required="required" placeholder="Es. ..."></li><br>
                                                    <li><label>Indirizzo agenzia/associazione:</label><input type="text" name="indirizzo" id="indirizzo" required="required" placeholder="Es. Via Diaz 91 - 22100 Como"></li><br><br>
                                                    <li>
                                                        <label>Quante copie vuoi acquistare?&nbsp</label>
                                                        <select style="width:78px;" id="numeroLicenze" name="numeroLicenze" onchange="updatePrice()">
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
                                                    <li><label>Codice univoco:</label><input type="text" name="codiceUnivoco" id="codiceUnivoco" required="required" placeholder="Es. M5UXCR1"></li><br>
                                                    <li><label>Email agenzia/associazione:</label><input type="text" name="email" id="email" required="required" placeholder="Es. info@condefiliziacomo.it"></li><br>
                                                    <li><label>Recapito telefonico:</label><input type="text" name="telefono" id="telefono" required="required" placeholder="Es. 031271900"></li><br><br>
                                                    <div id="prezzo" style="height:35px; position:relative; top:8px;">(€ <?php echo $costo; ?> oltre IVA - € <?php echo $costo_iva; ?> IVA inclusa)</div>
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
                                                <li><b>Banca di riferimento: Credito Valtellinese</b></li><br>
                                                <li><b>IBAN: IT38Q0521610901000000057790</b></li><br>
                                                <li><b>Causale: Licenza prospetto di calcolo</b></li><br>
                                                <li><b id="dato_bancario">Somma da versare: € <?php echo $costo_iva; ?> IVA inclusa</b></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="center" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <br>In caso di problemi legati al pagamento contattare <a href="mailto:info@confediliziacomo.it" class="intestazione_piccolo"><b>info@confediliziacomo.it</b></a>
                                            <br>Per assistenza tecnica, contattare <a href="mailto:attestazioniaffitti@gmail.com" class="intestazione_piccolo"><b>attestazioniaffitti@gmail.com</b></a>
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
        const numeroLicenze = document.getElementById("numeroLicenze").value;
        document.getElementById("prezzo").innerHTML = "(€ " + (<?php echo $costo; ?> * numeroLicenze).toFixed(2) + " oltre IVA" + " - € " + (<?php echo $costo_iva; ?> * numeroLicenze).toFixed(2) + " IVA inclusa)";
        document.getElementById("dato_bancario").innerHTML = "Somma da versare: € " + (<?php echo $costo_iva; ?> * numeroLicenze).toFixed(2) + " IVA inclusa";
    }
</script>

</html>