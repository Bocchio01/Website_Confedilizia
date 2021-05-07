<?php 
include "conn.php";
$result = $connessione->query("SELECT id,Indice_controllo FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont = $row['Indice_controllo']+1;
        $id = $row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Indice_controllo='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <style type="text/css">
        @import url("Style_php_.css");
    </style>
</head>
<body>
    <title>Schema logico del sito</title>
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
                        <h1>Index: "Prospetto di calcolo"</h1>
                        <h2>schema logico sito</h2>
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
                    <td width="1000">
                        <div id="articolo" style="margin-left: 0px; margin-right: 0px;">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b>Per visitare una specifica pagina della mappa,<br>cliccare con il cursore/mouse sopra il corrispondente blocco colorato.</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="Img\Schema_logico_sito.jpg" usemap="#image-map">
                                                <map name="image-map">
                                                    <area target="_blank" alt="Indice_controllo"          title="Indice_controllo"          href=""                              coords="337,31,520,76"   shape="rect">
                                                    <area target="_blank" alt="Tabella_tutti_utenti"      title="Tabella_tutti_utenti"      href="Tabella_tutti_utenti.php"      coords="112,118,297,164" shape="rect">
                                                    <area target="_blank" alt="Tabella_controllo_licenze" title="Tabella_controllo_licenze" href="Tabella_controllo_licenze.php" coords="99,200,310,246"  shape="rect">
                                                    <area target="_blank" alt="Tabella_visite_sito"       title="Tabella_visite_sito"       href="Tabella_visite_sito.php"       coords="112,280,297,325" shape="rect">
                                                    <area target="_blank" alt="Scelta_programma"          title="Scelta_programma"          href="Scelta_programma.php"          coords="560,118,744,162" shape="rect">
                                                    <area target="_blank" alt="Richiesta_demo"            title="Richiesta_demo"            href="Richiesta_demo.php"            coords="400,202,583,247" shape="rect">
                                                    <area target="_blank" alt="Richiesta_illimitata"      title="Richiesta_illimitata"      href="Richiesta_illimitata.php"      coords="719,202,904,247" shape="rect">
                                                    <area target="_blank" alt="Download_demo"             title="Download_demo"             href="Download_demo.php"             coords="398,301,623,347" shape="rect">
                                                    <area target="_blank" alt="Download_illimitata"       title="Download_illimitata"       href="Download_illimitata.php"       coords="681,302,903,347" shape="rect">
                                                </map>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Le nuove pagine si apriranno in un'altra scheda.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr color="black" width="88%"><br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>