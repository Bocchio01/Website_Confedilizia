<?php

include_once "./_settings.php";
updateInteractions();


if (isset($_POST["submit"])) {
    try {
        addDownload("Demo", $_POST['token']);
        fileDownload(FILE_DOWNLOAD['DEMO']);
    } catch (Exception $e) {
        alert($e->getMessage());
    }
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
                                                <ul style="height: 68px;">
                                                    <br>
                                                    <li><label style="padding-right:2em">Inserisci il codice: </label><input type="text" name="token" id="token" required="required" placeholder="Es. 2gHjk53JFt"></li>
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