<?php
include "conn.php";
$sql = "INSERT INTO Visite_sito VALUES ()";

if(!$connessione->query($sql))
	{
		echo "Errore della query: " . $connessione->error . "."; 
    }
    
$result = $connessione->query("SELECT id FROM Visite_sito");
if($result->num_rows > 0) 
{
    while($row = $result -> fetch_array(MYSQLI_ASSOC))
    {
        $ultimo=$row['id']-1;
    }
}

if ($ultimo>=1)
{
	$result = $connessione->query("SELECT * FROM Visite_sito WHERE id='$ultimo'");
	while ($row = $result -> fetch_array(MYSQLI_ASSOC))
	{ 
		$a=$row["Scelta_programma"];
		$b=$row["Richiesta_demo"];
		$c=$row["Richiesta_illimitata"];
	}
	$somma_visite=$a+$b+$c;
    $connessione->query("UPDATE Visite_sito SET Somma_visite='$somma_visite' WHERE id='$ultimo'");
    $id=1;
    $incassi_precedenti=0;
    while ($id != $ultimo) 
    {
    	$result = $connessione->query("SELECT * FROM Visite_sito WHERE id='$id'");
		while ($row = $result -> fetch_array(MYSQLI_ASSOC))
		{ 
    	    $incassi_settimana_id=$row["Vendite"];
		}
        $incassi_precedenti=$incassi_settimana_id+$incassi_precedenti;
        $id=$id+1;
   	}
        
    $incasso=0;
    $result = $connessione->query("SELECT codiceL,N_licenze FROM Utenti_prospetto");
	while ($row = $result -> fetch_array(MYSQLI_ASSOC))
	{ 
		if($row["codiceL"]!=NULL)
        {
        	$incasso=$incasso+$row["N_licenze"];
		}
    }
 	$incasso=$incasso-$incassi_precedenti;
    $connessione->query("UPDATE Visite_sito SET Vendite='$incasso' WHERE id='$ultimo'");
}

if ($ultimo>=2)
{
	$penultimo=$ultimo-1;
	$result = $connessione->query("SELECT Somma_visite FROM Visite_sito WHERE id='$penultimo'");
	while ($row = $result -> fetch_array(MYSQLI_ASSOC))
	{
		$incremento=(($somma_visite-$row["Somma_visite"])/$row["Somma_visite"])*100;
	}
	$connessione->query("UPDATE Visite_sito SET Percentuale_incremento='$incremento' WHERE id='$ultimo'");   
}
$result->close();
$connessione->close();
?>