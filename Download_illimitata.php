<?php

include "_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    $result = Query("SELECT id, tokenIllimitato, downloadIllimitato, numeroLicenze FROM Utenti_prospetto WHERE tokenIllimitato = '$_POST[tokenDemo]' LIMIT 1");

    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($row["downloadIllimitato"] < $row["numeroLicenze"]) {
            Query("UPDATE Utenti_prospetto SET downloadIllimitato = downloadIllimitato+1 WHERE id = $row[id]");
            header("Location: ./File_download/Prospetto_di_calcolo_illimitato.xlsm");
        } else {
            if ($row["numeroLicenze"] == 1) echo "<script type = 'text/javascript'>alert('Ha già scaricato la licenza!');</script>";
            else echo "<script type = 'text/javascript'>alert('Ha già scaricato tutte le licenze!');</script>";
        }
    } else echo "<script type = 'text/javascript'>alert('Il tokenDemo inserito è sbagliato!');</script>";
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Download versione illimitata'), 1); ?>

<body>
    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo (render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'download versione illimitata'))); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b>Inserisci qui il tokenDemo ricevuto per e-mail.</b></td>
                                    </tr>
                                    <tr>
                                        <td><br>Salva il file sul tuo computer. Avrai cosi ottenuto il programma in versione illimitata.<br></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="82%" align="center">
                                <tbody>
                                    <tr>
                                        <form action="" method="post">
                                            <td style="text-align: left;">
                                                <ul style="height: 68px;">
                                                    <br>
                                                    <li>
                                                        <label style="padding-right:2em">Inserisci il tokenDemo: </label>
                                                        <input type="text" name="tokenDemo" id="tokenDemo" required="required" placeholder="Es. 2gHjk53JFt">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td align="center"><input class="submit" type="submit" value=" Scarica licenza " name="submit"></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%" align="center">
                                <tr>
                                    <td>
                                        <b>ATTENZIONE: </b>come specificato in fase d'acquisto, il software è unico e potrà essere utilizzato solo su <b>un</b> computer.<br>
                                        Nel caso non volessi averlo sul PC dove stai lavorando, riapri questa pagina web dal PC desiderato e scaricalo da lì.
                                    </td>
                                </tr>

                                <?php echo (render('./template/site/footer.php', array())); ?>

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