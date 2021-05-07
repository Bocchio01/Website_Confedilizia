<?php 
include "conn.php";
$result = $connessione->query("SELECT id, Tabella_controllo_licenze FROM Visite_sito");

if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $cont=$row['Tabella_controllo_licenze']+1;
        $id=$row['id'];
    }
    $connessione->query("UPDATE Visite_sito SET Tabella_controllo_licenze='$cont' WHERE id='$id' ") ;
}
$result->close();
$connessione->close();
 
include "prezzi.php";
if(isset($_POST['e_mail']))
{
    $e_mail = $_POST['e_mail'];
    include "conn.php";
    $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codice_rand ='' ;
    for ($i=0; $i<10;$i++) 
    {
         $codice_rand .= $caratteri [rand(0, strlen ($caratteri) -1)]; 
    } 
    if (!$result = $connessione->query("SELECT id,email,codiceL FROM Utenti_prospetto")) 
    {
    	echo "Errore della query: " . $connessione->error . ".";
        exit(); 
    }
    else 
    {  
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) 
        {
            if ($row["email"]==$e_mail)
            {
                if($row["codiceL"]==NULL)
                {
                    $id=$row['id'];
        			$connessione->query("UPDATE Utenti_prospetto SET codiceL='$codice_rand' WHERE id=$id");
                    echo "<script type= 'text/javascript'>alert('Licenza inviata correttamente');</script>";
        
$messaggio = "Siamo lieti di comunicarti che abbiamo ricevuto il tuo pagamento per la versione illimitata del software 'Prospetto di calcolo'.
Per ottenere il software, clicca sul link sottostante ed inserisci questo codice: ".$codice_rand.".
Una volta scaricato avrai libero accesso al software.
Se hai bisogno di aiuto, segui la guida in allegato.
Se hai acquistato piu' copie del software: ti raccomandiamo di scaricarne una per ogni PC sul quale vuoi utilizzarla.
Una volta scaricata una copia su un PC non sara' piu' possibile spostarla su uno diverso.

Link download versione illimitata: 'https://attestazioniaffitti.altervista.org/confediliziacomo/Download_illimitata.php'

Grazie e buona giornata,
Confedilizia Como";
                                        
                    include "allegatomail.php";
                     mail($e_mail,$subject,$messaggio_tot,$headers);
                }
            }
        }
    }
    $result->close();
    $connessione->close();
}?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Style_tabelle.css">
    </head>
<body>
    <title>Autorizzazioni licenze illimitate</title>
    <meta charset="UTF-8">
    <meta name="author" content="Lo sviluppatore T.B.">
    <table align="center" border=2 cellpadding="10" cellspacing="10">
        <tr>
            <th>Ragione sociale</th>
            <th>Codice univoco</th>
            <th>E-mail</th>
            <th>Prezzo da pagare</th>
            <th>Attivare licenza? -> Solo se pagamento effettuato!</th>
        </tr>
        <?php 
        $n=-1;
        include "conn.php";
        if (!$result = $connessione->query("SELECT nome,email,c_univoco, codiceL,controlloL,N_licenze FROM Utenti_prospetto")) 
        {
            echo "Errore della query: " . $connessione->error . ".";
            exit();
        }
        else
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    if ($row['controlloL']=='0' && $row['codiceL']=='')
                    {
                        $n=$n+1;
                        $prezzo=$costo_iva*$row['N_licenze'];?>
                        <tr>
                            <td><?php echo $row['nome'] ?></td>
                            <td><?php echo $row['c_univoco'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $prezzo." €" ?></td>
                            <td><form style="margin:0px;" action="" method="post"><input type="hidden" name="e_mail" value="<?php echo $row['email']?>"> <input type="submit" value=" Attiva licenza "></form></td>
                        </tr>
                    <?php 
                    }
                }
            }    
        $result->close(); 
        $connessione->close();?>
    </table>
</body>
</html>