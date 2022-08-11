<html>

<?php echo render('./template/site/head.php', array('title' => 'Download versione demo'), 1); ?>

<body>

    <div align="center">
        <table style="border: 0px; background-color: white; width:1000px;" cellpadding="0" cellspacing="0">
            <tbody>

                <?php echo render('./template/site/menu.php', array('title' => 'Pagina di login', 'subtitle' => "accedi all'area riservata")); ?>

                <tr>
                    <td width="1000px">
                        <div id="articolo">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>Inserisci la password di accesso all'area riservata</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="82%" align="center">
                                <tbody>
                                    <tr>
                                        <form action="<?php echo $fromURL ?>" method="post">
                                            <td style="text-align: left;">
                                                <ul style="height: 68px;">
                                                    <br>
                                                    <li><label style="padding-right:2em">Inserisci la password: </label><input type="text" name="api_key" id="api_key" required="required"></li>
                                                </ul>
                                            </td>
                                            <td align="center"><input class="submit" type="submit" value="Login" name="submitLogin"></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="80%" align="center">

                                <?php echo render('./template/site/footer.php', array()); ?>

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