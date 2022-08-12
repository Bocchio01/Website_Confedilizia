<?php

include_once "./_settings.php";
updateInteractions();

include_once "./_isAdmin.php";


if (isset($_POST['submit'])) {

    try {
        $valueArray = array(
            'id'    => $_POST['id'],
            'email' => parseEmail($_POST["email"]),
            'token' => $_POST['token'],
        );

        $mailArray = array(
            'email'   => $valueArray['email'],
            'subject' => $subject,
            'msg'     => render('./template/email/controlloLicenze.php', $valueArray),
            'headers' => $headers
        );

        setPayment($valueArray['id']);
        sendEmail($mailArray);
        alert('Licenza inviata correttamente');
    } catch (Exception $e) {
        alert($e->getMessage());
    }
}


$result  = Query("SELECT 
                    I.id, 
                    U.email, 
                    U.nameCompany, 
                    U.codeUnivocal, 
                    I.token, 
                    I.nLicences, 
                    I.priceEach 
                FROM Utenti_prospetto AS U 
                JOIN Illimitata_data AS I 
                WHERE U.id = I.idUser AND I.hasPayed = 0 
                ORDER BY I.dateRequest");


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Autorizzazioni licenze illimitate'), 1); ?>

<body>
    <a href="/">
        <h1>Prospetto di calcolo</h1>
    </a>
    <h3>Tabella controllo licenze</h3>
    <table>
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
                        <td><?php echo $row['nameCompany'] ?></td>
                        <td><?php echo $row['codeUnivocal'] ?></td>
                        <td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></td>
                        <td><?php echo number_format($swPrice * (int) $row['nLicences'] * 1.22, 2, '.', '') ?> €</td>
                        <td>
                            <form style="margin:0px; text-align:center" action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                <input type="hidden" name="token" value="<?php echo $row['token'] ?>">
                                <input type="submit" name="submit" value="Attiva licenza">
                            </form>
                        </td>
                    </tr>
            <?php
                endwhile;
            else :
                echo "<h3>Nessuna licenza da attivare. Buon lavoro!</h3>";
            endif;
            ?>
        </tbody>
    </table>
</body>

</html>