<?php

include "_settings.php";
updateInteractions();


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $codice_rand = CreateToken(10);

    $result = Query("SELECT id, email, tokenIllimitato FROM Utenti_prospetto WHERE id = $id");
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row["tokenIllimitato"] == NULL) {
        Query("UPDATE Utenti_prospetto SET tokenIllimitato = '$codice_rand' WHERE id = $id");
        echo "<script type = 'text/javascript'>alert('Licenza inviata correttamente');</script>";

        $msg = render('./template/email/controlloLicenze.php', array('codice_rand' => $codice_rand,));

        mail($row['email'], $subject, $msg, $headers);
    }
}


$result = Query("SELECT id, ragioneSociale, email, codiceUnivoco, tokenIllimitato, downloadIllimitato, numeroLicenze FROM Utenti_prospetto WHERE tokenIllimitato IS NULL");

$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Autorizzazioni licenze illimitate'), 1); ?>

<head>
    <style>
        @import url(<?php echo UTILS_SITE ?>/template/site/_style_table.css);
    </style>
</head>

<body>
    <h2>Tabella controllo licenze</h2>
    <table border='1'>
        <thead>
            <tr>
                <th>Ragione sociale</th>
                <th>Codice univoco</th>
                <th>E-mail</th>
                <th>Prezzo da pagare</th>
                <th>Attivare licenza? -> Solo se pagamento effettuato!</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) :
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) :
            ?>
                    <tr>
                        <td><?php echo $row['ragioneSociale'] ?></td>
                        <td><?php echo $row['codiceUnivoco'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo number_format($costo * $row['numeroLicenze'] * 1.22, 2, '.', '') ?> €</td>
                        <td>
                            <form style="margin:0px; text-align:center" action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <input type="submit" value=" Attiva licenza ">
                            </form>
                        </td>
                    </tr>
            <?php
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</body>

</html>