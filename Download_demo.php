<?php

include "_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    $result = Query("SELECT id, tokenDemo, downloadDemo FROM Utenti_prospetto WHERE tokenDemo = '$_POST[tokenDemo]' LIMIT 1");

    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($row["downloadDemo"] == 0) {
            Query("UPDATE Utenti_prospetto SET downloadDemo = 1 WHERE id = $row[id]");
            header("Location: ./File_download/Prospetto_di_calcolo_demo.xlsm");
        } else echo "<script type = 'text/javascript'>alert('Ha già scaricato il software versione demo!');</script>";
    } else echo "<script type = 'text/javascript'>alert('Il tokenDemo inserito è sbagliato!');</script>";
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Download versione demo'), 1); ?>

<body>
    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo (render('./template/site/menu.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'download versione demo'))); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b>Inserisci qui il tokenDemo che hai ricevuto per e-mail.</b></td>
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
                                                <ul style="height: 68px;">
                                                    <br>
                                                    <li><label style="padding-right:2em">Inserisci il tokenDemo: </label><input type="text" name="tokenDemo" id="tokenDemo" required="required" placeholder="Es. 2gHjk53JFt"></li>
                                                </ul>
                                            </td>
                                            <td align="center"><input class="submit" type="submit" value=" Scarica software&nbsp;" name="submit"></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="80%" align="center">

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