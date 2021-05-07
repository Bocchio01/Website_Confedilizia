<?php 
include "conn.php";
$result = $connessione->query("SELECT id, Tabella_tutti_utenti FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Tabella_tutti_utenti']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Tabella_tutti_utenti='$cont' WHERE id=$id ") ;
}
$result->close();
$connessione->close(); 
?> 
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Style_tabelle.css">
    </head>
<tbody>
    <title>Tabella completa tutti gli utenti</title>
    <meta charset="UTF-8">
    <meta name="author" content="Lo sviluppatore T.B.">
    <table align="center" border="2" cellpadding="10" cellspacing="10">
        <tr>
            <th>Ragione sociale</th>
            <th>Codice univoco</th>
            <th>Partita IVA</th>
            <th>E-mail</th>
            <th>Indirizzo</th>
            <th>Telefono</th>
            <th id="separatore"></th>
        <!--<th>Codice demo</th>
            <th>Demo</th>
            <th>Data / ora richiesta demo</th>
            <th id="separatore"></th>-->
            <th>Codice licenza</th>
            <th>N. Licenze</th>
            <th>Data / ora richiesta illimitata</th>
        </tr>
        <?php include "conn.php";
        if (!$result = $connessione->query("SELECT * FROM Utenti_prospetto")) {
	        echo "Errore della query: " . $connessione->error . ".";
	        exit(); }
        else
            if($result->num_rows > 0)
                while($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['nome'] ?></td>
                    <td><?php echo $row['c_univoco'] ?></td>
                    <td><?php echo $row['IVA'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['indirizzo'] ?></td>
                    <td><?php echo $row['telefono'] ?></td>
                    <td id="separatore"></td>
                <!--<td><?php echo $row['codice'] ?></td>
                    <td><?php
                        if ($row['controllo']==0 && $row['controlloL']=='') echo "Non scaricata";
                        if ($row['controllo']==1 && $row['controlloL']=='') echo "Scaricata";
                        if ($row['controllo']==0 && $row['controlloL']!='') echo "Proroga non scaricata";
                        if ($row['controllo']==1 && $row['controlloL']!='') echo "Proroga";?>
                    </td>
                    <td><?php echo $row['data_ora'] ?></td>
                    <td id="separatore"></td>-->
                    <td><?php echo $row['codiceL'] ?></td>
                    <td> <?php 
                        switch ($row['controlloL']) 
                        {
                            case '':
                                echo "Non richiesta";
                                break;
                            case 0:
                                if ($row['codiceL']=='') 
                                {
                                    echo "In attesa del pagamento..";
                                }
                                else
                                {
                                    echo "Scaricate 0/".$row['N_licenze'];
                                }
                                break;
                            default:
                                echo "Scaricate ".$row['controlloL']."/".$row['N_licenze'];
                                break;
                        }?>
                    </td>
                    <td><?php echo $row['data_oraL'] ?></td>
                </tr>
        <?php }
        $result->close(); 
        $connessione->close();?>
    </table>
</tbody>
</html>