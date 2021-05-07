<?php 
include "conn.php";
$result = $connessione->query("SELECT id,Richiesta_illimitata FROM Visite_sito");
if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Richiesta_illimitata']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Richiesta_illimitata='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close(); 

include "prezzi.php";
if (isset($_POST["submit"]))
{
    include "conn.php";
    $prezzo = $costo*$_POST["N_licenze"];
    $prezzo_IVA = $costo_iva*$_POST["N_licenze"];
    $subject    = 'Software prospetto di calcolo';
    $subject1   = 'Dati fatturazione';
    $headers    = 'From: info@confediliziacomo.it';
    $utente = 0;
    $illimitato = 0;
    $pagato = 0;
    $min = strtolower($_POST["email"]);
    $to_email   = $min;
    $to_email1  = 'info@confediliziacomo.it';
    $message1   = 'Ciao, hai una nuova richiesta di licenza illimitata per il software prospetto di calcolo:
Ecco i dati del richiedente:
Ragione sociale:  '.$_POST["nome"].';
Partita IVA:            '.$_POST["IVA"].';
Codice univoco:   '.$_POST["c_univoco"].';
Indirizzo:	  '.$_POST["indirizzo"].';
Ha richiesto N. '.$_POST["N_licenze"].' copie illimitate e dovra quindi pagare '.$prezzo.'.00€ oltre IVA, o '.$prezzo_IVA.'.00€ IVA inclusa.

Se hai bisogno di scrivergli, questa è la sua e-mail: '.$min.';

Ricordati che per attivargli la licenza, dovrai andare sul sito: https://attestazioniaffitti.altervista.org/confediliziacomo/Tabella_controllo_licenze.php
Mi raccomando, attivala solo se hai ricevuto il pagamento!';

    $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codice_rand ='' ;
    for ($i=0; $i<10;$i++) 
    {
        $codice_rand .= $caratteri [rand(0, strlen ($caratteri) -1)];
    }
    if (!$result = $connessione->query("SELECT * FROM Utenti_prospetto")) 
    {
        echo "Errore della query: " . $connessione->error . ".";
        exit(); 
    }
    else 
    {
        if($result->num_rows > 0) 
        {
            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) 
            {
                if($row["email"]==$min)
                { 
                    $utente=1;
                    if ($row["telefono"]!=0)
                    {
                        $illimitato=1;
                        if ($row["codiceL"]!=NULL)
                        {
                            $pagato=1;
                        }
                        else
                        {
                            $pagato=0;
                        }
                    }
                }
            }
        }

        if ($utente==0 && $illimitato==0 && $pagato==0)
        {
            $connessione->query("INSERT INTO Utenti_prospetto (nome, email, c_univoco, IVA, indirizzo, telefono, codice, controllo, controlloL, N_licenze, data_oraL) VALUES ('".$_POST["nome"]."','$min','".$_POST["c_univoco"]."','".$_POST["IVA"]."','".$_POST["indirizzo"]."','".$_POST["telefono"]."','$codice_rand','0','0','".$_POST["N_licenze"]."', now())");
            echo "<script type= 'text/javascript'>alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');</script>";
                
$message = 'Siamo lieti '.$_POST['nome'].' che tu abbia scelto la versione illimitata del nostro programma.
Ti preghiamo dunque, nel caso non lo avessi ancora fatto, di procedere al pagamento di € '.$prezzo.'.00 oltre IVA, avendo scelto di acquistare N. '.$_POST["N_licenze"].' copie.

Di seguito gli estremi bancari:

    -Banca di riferimento: Credito Valtellinese
    -IBAN: IT38Q0521610901000000057790
    -Causale: Licenza prospetto di calcolo
    -Somma da versare: € '.$prezzo_IVA.'.00 (IVA inclusa)


Grazie e buona giornata,
Confedilizia Como';
 
            mail($to_email,$subject,$message,$headers);
            mail($to_email1,$subject1,$message1);
        }
    
        if ($utente==1 && $illimitato==0 && $pagato==0) 
        {
            $result = $connessione->query("SELECT codice FROM Utenti_prospetto WHERE email='$min'");
            $row = $result -> fetch_array(MYSQLI_ASSOC);
            $connessione->query("UPDATE Utenti_prospetto SET nome='".$_POST["nome"]."', c_univoco='".$_POST["c_univoco"]."', IVA='".$_POST["IVA"]."', codice='".$codice_rand."', telefono='".$_POST["telefono"]."', indirizzo='".$_POST["indirizzo"]."', controlloL='0', controllo='0', N_licenze='".$_POST["N_licenze"]."', data_oraL=now() WHERE email='$min'");
            echo "<script type= 'text/javascript'>alert('Richiesta effettuata con successo. Controlla la tua casella e-mail');</script>";
        
$message = 'Siamo lieti '.$_POST['nome'].' che tu abbia scelto di passare alla versione illimitata del nostro programma.
Ti preghiamo dunque, nel caso non lo avessi ancora fatto, di procedere al pagamento di € '.$prezzo.'.00 oltre IVA, avendo scelto di acquistare N. '.$_POST["N_licenze"].' copie.

Di seguito gli estremi bancari:

    -Banca di riferimento: Credito Valtellinese
    -IBAN: IT38Q0521610901000000057790
    -Causale: Licenza prospetto di calcolo
    -Somma da versare: € '.$prezzo_IVA.'.00 (IVA inclusa)


Se hai necessità di prorogare per altri 7 giorni il tuo programma provvisorio, scarica di nuovo la versione demo da questo link:
"https://attestazioniaffitti.altervista.org/confediliziacomo/Download_demo.php"

Il codice con cui scaricare il software è il seguente: '.$codice_rand.'.
Grazie e buona giornata,
Confedilizia Como';
 
            mail($to_email,$subject,$message,$headers);
            mail($to_email1,$subject1,$message1);
        }

        if ($utente==1 && $illimitato==1 && $pagato==0) 
        {
            echo "<script type= 'text/javascript'>alert('Paga il precedente ordine per acquistare ulteriori licenze!');</script>";
        }

        if ($utente==1 && $illimitato==1 && $pagato==1) 
        {
            $connessione->query("INSERT INTO Utenti_prospetto (nome, email, c_univoco, IVA, indirizzo, telefono, codice, controllo, controlloL, N_licenze, data_oraL) VALUES ('".$_POST["nome"]."','$min','".$_POST["c_univoco"]."','".$_POST["IVA"]."','".$_POST["indirizzo"]."','".$_POST["telefono"]."','$codice_rand','0','0','".$_POST["N_licenze"]."', now())");
            echo "<script type= 'text/javascript'>alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');</script>";

$message = 'Siamo lieti '.$_POST['nome'].' che tu abbia scelto di avere ulteriori copie software illimitate.
Ti preghiamo dunque, nel caso non lo avessi ancora fatto, di procedere al pagamento di € '.$prezzo.'.00 oltre IVA, avendo scelto di acquistare N. '.$_POST["N_licenze"].' copie.

Di seguito gli estremi bancari:

    -Banca di riferimento: Credito Valtellinese
    -IBAN: IT38Q0521610901000000057790
    -Causale: Licenza prospetto di calcolo
    -Somma da versare: € '.$prezzo_IVA.'.00 (IVA inclusa)


Grazie e buona giornata,
Confedilizia Como';
 
            mail($to_email,$subject,$message,$headers);
            mail($to_email1,$subject1,$message1);
        }
    }
    $result->close();       
    $connessione->close();
}?>
<!DOCTYPE html>
<html lang="it">
<head>
    <style type="text/css">
        @import url("Style_php_.css");
    </style>
</head>
<body>
    <title>Richiesta per versione illimitata</title>
    <meta charset="UTF-8">
    <meta name="author" content="Lo sviluppatore T.B.">
    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td><img src="Img\Logo0.jpg" title="Confedilizia Como e Castel Baradello"></td>
                </tr>
                <tr>
                    <td height="30">
                        <table style="border:0px; width: 1000px;" cellspacing="7" cellpadding="7">
                            <tbody>
                                <tr>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/index.html">&nbsp;PRESENTAZIONE&nbsp;</a></td>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/Consiglio.htm">&nbsp;CONSIGLIO&nbsp;</a></td>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/Servizi.htm">&nbsp;SERVIZI&nbsp;</a></td>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/Normativa.htm">&nbsp;NORMATIVA&nbsp;</a></td>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/Consulenti.htm">&nbsp;CONSULENTI&nbsp;</a></td>
                                    <td class="Menu_Principale"><a href="http://www.confediliziacomo.it/Amministratori.htm">&nbsp;REGISTRO AMMINISTRATORI&nbsp;</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1>Prospetto di calcolo</h1>
                        <h2>richiesta software illimitato</h2>
                        <div id="articolo">
                            <br>
                            <table width="100%" style="margin-left: 0px; margin-right: 0px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b id="intestazione_grande">Associazione della Proprietà Edilizia</b><br>
                                            <b id="intestazione_grande">Via Diaz 91 - 22100 Como</b><br>
                                            <b id="intestazione_piccolo">tel. e fax. 031.271.900</b><br>
                                            <a href="mailto:info@confediliziacomo.it" id="intestazione_piccolo"><b>&nbsp;info@confediliziacomo.it&nbsp;</b></a>
                                            <br><br>
                                            <hr width="420">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <hr width="420">
                    </td>
                </tr>
                <tr>
                    <td width="1000px">
                        <div id="articolo" style="margin-left: 0px; margin-right: 0px;">
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td><b>Il costo della licenza illimitata è di € <?php echo $costo; ?>,00 oltre IVA caduna da versare a Confedilizia Como.</b></td>
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
                                        <td align="left"><br><br><h2 style="text-align: left;">- Dati anagrafici</h2></td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="" method="post">
                            <table align="center" width="82%">
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">
                                            <ul>
                                                    <li><label>Ragione sociale:</label><input class="simple-input" type="text" name="nome" id="nome" required="required" placeholder="Es. A.P.E. – COMO"></li><br>
                                                    <li><label>Partita IVA:</label><input class="simple-input" type="text" name="IVA" id="IVA" required="required" placeholder="Es. ..."></li><br>
                                                    <li><label>Indirizzo agenzia/associazione:</label><input class="simple-input" type="text" name="indirizzo" id="indirizzo" required="required" placeholder="Es. Via Diaz 91 - 22100 Como"></li><br><br>
                                                    <li>
                                                    	<label>Quante copie vuoi acquistare?&nbsp</label>
                                               			<select class="simple-input" style="width:78px;" id="N_licenze" name="N_licenze" onchange="calc()">
															<option selected value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
                                                		    <option value="5">5</option>
														</select>
                                                        <p style="margin: 0px; display: inline-block; padding-left: 34px;">-></p>
                                                    </li>
                                            </ul>
                                        </td>
                                        <td style="text-align: left;">
                                            <ul>
                                                    <li><label>Codice univoco:</label><input class="simple-input" type="text" name="c_univoco" id="c_univoco" required="required" placeholder="Es. M5UXCR1"></li><br>
													<li><label>Email agenzia/associazione:</label><input class="simple-input" type="text" name="email" id="email" required="required" placeholder="Es. info@condefiliziacomo.it"></li><br>
                                                    <li><label>Recapito telefonico:</label><input class="simple-input" type="text" name="telefono" id="telefono" required="required" placeholder="Es. 031271900"></li><br><br>
                                           			<div id="prezzo" style="height:35px; position:relative; top:8px;">(€ <?php echo $costo; ?>.00 oltre IVA - € <?php echo $costo_iva; ?> IVA inclusa)</div>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td>
											<script>
												function calc() 
                                            		{
														var element = document.getElementById("N_licenze").value;
												  		document.getElementById("prezzo").innerHTML = "(€ "+<?php echo $costo; ?>*element+".00 oltre IVA"+" - € "+<?php echo $costo_iva; ?>*element+".00 IVA inclusa)";
                                            	       	document.getElementById("dato_bancario").innerHTML = "Somma da versare: € "+<?php echo $costo_iva; ?>*element+".00 IVA inclusa";
                                            		}
											</script>
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
                                            <br>In caso di problemi legati al pagamento contattare <a href="mailto:info@confediliziacomo.it" id="intestazione_piccolo"><b>info@confediliziacomo.it</b></a>
                                            <br>Per assistenza tecnica, contattare <a href="mailto:attestazioniaffitti@gmail.com" id="intestazione_piccolo"><b>attestazioniaffitti@gmail.com</b></a>
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
</html>