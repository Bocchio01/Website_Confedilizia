<?php 
include "conn.php";
$result = $connessione->query("SELECT id, Richiesta_demo FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Richiesta_demo']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Richiesta_demo='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close();

if(isset($_POST["submit"]))
{
    include "conn.php";
    $subject = 'Software prospetto di calcolo';
    $headers = 'From: info@confediliziacomo.it';
    $utente_ripetuto=0;
    $to_email = strtolower($_POST["email"]);

    $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codice_rand ='' ;
    for ($i=0; $i<10;$i++)
    {
        $codice_rand .= $caratteri [rand(0, strlen ($caratteri) -1)];
    }

    if (!$result = $connessione->query("SELECT email FROM Utenti_prospetto"))
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
                if ($to_email == $row["email"]) 
                {
        		    $utente_ripetuto=1;
                    echo "<script type= 'text/javascript'>alert('Hai gia richiesto il software con la stessa email. Operazione bloccata!');</script>"; 
                }
            }
        }
    }
		
    if ($utente_ripetuto==0)
    {
        $sql = "INSERT INTO Utenti_prospetto (nome, email,indirizzo,telefono, codice, controllo) VALUES ('".$_POST["nome"]."','$to_email','-','0','$codice_rand','0')";
        if ($connessione->query($sql) === TRUE) 
        {
		    echo "<script type= 'text/javascript'>alert('Richiesta effettuata con successo! Controlla la tua casella e-mail');</script>";
$message = 'Grazie '.$_POST['nome'].' per aver scelto di provare il nostro programma gratuito per 7 giorni.
Per ottenere il programma clicca sul link sottostante ed inserisci questo codice: '.$codice_rand.'.

Link download: "https://attestazioniaffitti.altervista.org/confediliziacomo/Download_demo.php"


Se desideri richiedere la versione del programma senza limitazioni (a pagamento) visita la pagina "https://attestazioniaffitti.altervista.org/confediliziacomo/Richiesta_illimitata.php".';
 
            mail($to_email,$subject,$message,$headers); 
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
    <title>Richiesta per versione demo</title>
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
                        <h2>richiesta software demo</h2>
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
                        <hr width="420"><br>
                    </td>
                </tr>
                <tr>
                    <td width="1000px">
                        <div id="articolo" style="margin-left: 0px; margin-right: 0px;">
                            <table align="center" width="88%">
                                <tbody>
                                    <tr>
                                        <td><b>Per ricevere il programma di calcolo inserisci di seguito i dati richiesti.</b></td>
                                    </tr>
                                    <tr>
                                        <td><br><b>Ti verrà inviato per e-mail il link da cui poter scaricare il programma.</b></td>
                                    </tr>
                                    <tr>
                                        <table align="center" width="82%">
                                            <tbody>
                                                <tr>
                                                    <form action="" method="post">
                                                        <td style="text-align: left;">
                                                            <ul>
                                                                <br><li><label style="padding-right:7em">Ragione sociale:</label>&nbsp;<input class="simple-input" type="text" name="nome" id="nome" required="required" placeholder="Es. Confedilizia Como"></li>
                                                                <br><li><label style="padding-right:2em">Email agenzia/associazione:</label><input class="simple-input" type="text" name="email" id="email" required="required" placeholder="Es. info@confediliziacomo.it"></li>
                                                            </ul>
                                                        </td>
                                                        <td align="center"><input style="margin-top: 20px;" class="submit" type="submit" value=" Invia " name="submit"></td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="88%" align="center">
                                            <tr>
                                                <td><br>N.B. La versione che si sta richiedendo è solo una prova gratuita con una validità di 7 giorni.<br>Per assistenza tecnica, contattare <a href="mailto:attestazioniaffitti@gmail.com" id="intestazione_piccolo"><b>attestazioniaffitti@gmail.com</b></a></td>
                                            </tr>
                                        </table>
                                        <hr color="black" width="88%">
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