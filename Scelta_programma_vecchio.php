<?php 
include "conn.php";
$result = $connessione->query("SELECT id, Scelta_programma FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Scelta_programma']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Scelta_programma='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close();
include "prezzi.php";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <style type="text/css">
        @import url("Style_php_.css");
    </style>
</head>
<body>
    <title>Scelta della versione</title>
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
                        <h2>scelta versione</h2>
                        <div id="articolo">
                            <br>
                            <table width="100%">
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
                    <td width="1000">
                        <div id="articolo" style="margin-left: 0px; margin-right: 0px;">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="font-size: x-large;"><b>Il software:</b></td>
                                    </tr>
                                    <tr>
                                        <td width="88%">
                                            <br>
                                            <table align="center" style="border:0px; width: 820px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 410px; text-align: left;">
                                                            <ul>
                                                                <li>Permette di calcolare in maniera istantanea il <b>canone di locazione</b> per una specifica unità abitativa nel comune di Como.</li><br>
                                                                <li>La probabilità di commettere errori di calcolo si riduce a zero.</li><br>
                                                                <li>Possibilità di esportare il prospetto come documento PDF.</li><br>
                                                                <li>Possibilità di stampare il prospetto in maniera ordinata e chiara.</li>
                                                                <br><br><br>Se vuoi visualizzare un esempio di PDF stampabile generato automaticamente dal programma, clicca qui: <a href="Img\Esempio_PDF.pdf">Esempio PDF</a>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <div><iframe style="height: 370px; width: 370px;" src="Img\Video_excel.mp4"></iframe></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b><br><br>Scegli la versione che desideri ottenere:</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="80%" align="center">
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">
                                            <ul>
                                                <li><a href="Richiesta_demo.php">Versione demo (Gratuita):</a> consente un utilizzo del software completo per 7 giorni.</li><br>
                                                <li><a href="Richiesta_illimitata.php">Versione illimitata (Costo: €. <?php echo $costo; ?>,00 oltre IVA):</a> consente un utilizzo del software completo per una durata illimitata ed eventuale assistenza tecnica.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Requisiti del sistema: Microsoft Excel 2010 o versioni successive<br>
                                            <br>Per assistenza tecnica, contattare <a href="mailto:attestazioniaffitti@gmail.com" id="intestazione_piccolo"><b>attestazioniaffitti@gmail.com</b></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr color="black" width="88%">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>