<?php 
include "conn.php";
$result = $connessione->query("SELECT id, Download_demo FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Download_demo']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Download_demo='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close();

if(isset($_POST["submit"]))
{
    include "conn.php";
    $i=0; 
    if (!$result = $connessione->query("SELECT codice, controllo FROM Utenti_prospetto")) 
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
                if ($_POST["codice"] == $row["codice"]) 
                {
                    $i=1;
                    if ($row["controllo"] == 0) 
                    {
               	        $cod=$row["codice"];
        		        header("Location: File_download/Prospetto_di_calcolo_demo.xlsm");
                        $connessione->query("UPDATE Utenti_prospetto SET controllo='1' WHERE codice='$cod'");
                    }
                    else
                    {  
                        echo "<script type= 'text/javascript'>alert('Ha già scaricato il software versione demo!');</script>";
                    }
                }
            }
        }
        if ($i==0)
        {
            echo "<script type= 'text/javascript'>alert('Il codice inserito è sbagliato!');</script>"; 
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
    <title>Download versione demo</title>
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
                        <h2>download versione demo</h2>
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="1000px">
                        <div id="articolo" style="margin-left: 0px; margin-right: 0px;">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b>Inserisci qui il codice che hai ricevuto per e-mail.</b></td>
                                    </tr>
                                    <tr>
                                        <td><br>Ti ricordiamo che potrai scaricarlo solo una volta e che il software funzionerà per 7 giorni dal primo avvio.<br></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="82%" align="center">
                                <tbody>
                                    <tr>
                                        <form action="" method="post">
                                            <td style="text-align: left;">
                                                <ul style="height: 68px;" >
                                                    <br><li ><label style="padding-right:2em">Inserisci il codice: </label><input class="simple-input" type="text" name="codice" id="codice" required="required" placeholder="Es. 2gHjk53JFt"></li>
                                                </ul>
                                            </td>
                                            <td align="center"><input class="submit" type="submit" value=" Scarica software&nbsp;" name="submit" ></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="80%" align="center">
                                <tr>
                                    <td>
                                        <br>Per assistenza tecnica, contattare <a href="mailto:attestazioniaffitti@gmail.com" id="intestazione_piccolo"><b>attestazioniaffitti@gmail.com</b></a>
                                    </td>
                                </tr>
                            </table>
                        <hr color="black" width="88%"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>