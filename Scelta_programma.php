<?php

include_once "./_settings.php";
updateInteractions();


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Software ConfediliziaComo'), 1); ?>

<body>
    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo (render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'software ConfediliziaComo'))); ?>

                <tr>
                    <td width="1000">
                        <div id="articolo">
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
                                                                <br><br><br>Se vuoi visualizzare un esempio di PDF stampabile generato automaticamente dal programma, clicca qui: <a href="./assets/Esempio_PDF.pdf">Esempio PDF</a>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <div><iframe style="height: 370px; width: 370px;" src="./assets/Video_excel.mp4" loading="lazy"></iframe></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td><b><br><br>Scegli la versione che desideri ottenere:</b></td> -->
                                        <td><b><br><br>Ottieni il software:</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="80%" align="center">
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">
                                            <ul>
                                                <!-- <li><a href="./Richiesta_demo.php">Versione demo (Gratuita):</a> consente un utilizzo del software completo per 7 giorni.</li><br> -->
                                                <li><a href="./Richiesta_illimitata.php">Versione illimitata (Costo: €. <?php echo $swPrice; ?> oltre IVA):</a> consente un utilizzo del software completo per una durata illimitata ed eventuale assistenza tecnica.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Requisiti del sistema: Microsoft Excel 2010 o versioni successive<br>
                                            <b>Non compatibile</b> con: OpenOffice, dispositivi mobile (telefoni e/o tablet)<br>
                                            <br>Per assistenza tecnica, contattare <a href="mailto:<?php echo EMAIL['MASTER'] ?>" class="intestazione_piccolo"><b><?php echo EMAIL['MASTER'] ?></b></a>
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