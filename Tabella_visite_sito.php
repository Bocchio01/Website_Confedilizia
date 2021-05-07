<!DOCTYPE html>
<html lang="it">
<head>
<link rel="stylesheet" href="Style_tabelle.css">
</head>
	<body>
	    <title>Statistiche del sito vendita prospetto</title>
	    <h1 style="text-align:center; margin-bottom:0px;">Numeri del sito</h1>
        <h3 style="text-align:center; margin-top:0px;">!L'ultimo record è rispetto alle 23:59 di domenica scorsa!</h3>
	    <meta charset="UTF-8">
	    <meta name="author" content="Lo sviluppatore T.B.">
	    <table align="center" border="2" cellpadding="10" cellspacing="10">
	    	<tbody>
        	    <tr>
	    	    	<th>Settimana dal (00:00 Lunedi - 23:59 Domenica)</th>
                    <th style="border:0px;"></th>
                    <th>Visite Scelta_programma</th>
	    	        <th>N. vendite (pagate)</th>
                    <th style="border:0px;"></th>
                    <th>Totale_visitatori</th>
					<th>Incremento_visitatori</th>
	    	    </tr>
	    	    <?php 
	    	    include "conn.php";
                $result = $connessione->query("SELECT id FROM Visite_sito");
				if($result->num_rows > 0) 
				{
				    while($row = $result -> fetch_array(MYSQLI_ASSOC))
				    {
				        $max_line=$row['id'];
				    }
				} 
	    	    $tot=0;
        	    $contatore=-1;
        	    $max=-1;
	    	    if (!$result = $connessione->query("SELECT * FROM Visite_sito ")) {
			        echo "Errore della query: " . $connessione->error . ".";
			        exit(); }
	    	    else
	    	        if($result->num_rows > 0)
	    	            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        	            if ($row["id"]!=$max_line){
                        $contatore=$contatore+1;
	    	            $tot=$tot+$row['Scelta_programma'];
                        $ultimo_scelta_programma=$row['Scelta_programma'];?>
	    	            <tr>
	    	                <td><?php echo $row['Data_salvataggio'] ?></td>
                            <th style="border:0px;"></th>
	    	                <td><?php echo $row['Scelta_programma'] ?></td>
	    	                <td><?php echo $row['Vendite'] ?></td>
                            <th style="border:0px;"></th>
	    	                <td><?php echo $row['Somma_visite'] ?></td>
	    	                <td><?php echo $row['Percentuale_incremento'];?>%</td>
	    	            </tr>
	    	    <?php
				$date= date('d/M/Y', strtotime($row['Data_salvataggio']));
        	    $array=[$date, $row['Scelta_programma']];
                $array1=[$date, $row['Vendite']];
        	    $dati[$contatore]=$array; 
                $dati1[$contatore]=$array1; 
        	    if ($row['Scelta_programma']>$max)
        	    	{
        	        	$max=$row['Scelta_programma'];
        	        }
        	    }}
                $media_visite=$tot/($contatore+1);
                $percentuale=(($ultimo_scelta_programma/$media_visite)-1)*100;
	    	    if ($media_visite<=$ultimo_scelta_programma) {?>
	    	    	<p style="text-align: center;">La pagina principale del sito è stata aperta <?php echo $ultimo_scelta_programma ?> volte questa settimana.<br>La media settimanale è di <?php echo round($media_visite, 2) ?> visite, e il sito è in crescita: +<?php echo round($percentuale, 0) ?>%</p>
	    	    <?php } else {?>
	    	    	<p style="text-align: center;">La pagina principale del sito è stata aperta <?php echo $ultimo_scelta_programma ?> volte questa settimana.<br>La media settimanale è di <?php echo round($media_visite, 2) ?> visite, ma il sito è in decrescita: <?php echo round($percentuale, 0) ?>%</p>
	    	    <?php }	
	    	    
	    	    
	    	    $result->close(); 
	    	    $connessione->close();?>
			</tbody>
		</table>
        <br><br>
        <?php
		include "conn.php";
		include "prezzi.php";
        $vend=0;
        $vend_attesa=0;
        $result = $connessione->query("SELECT codiceL,N_licenze FROM Utenti_prospetto");
		while ($row = $result -> fetch_array(MYSQLI_ASSOC))
			{ 
    	    	$vend_attesa=$vend_attesa+$row["N_licenze"];
                if ($row["codiceL"]!=NULL)
                	$vend=$vend+$row["N_licenze"];
    	    }
        $result->close(); 
	    $connessione->close();?>
        
		<div style="text-align:center;">
        	<script>document.write('<img src="Visite_sito_grafico.gif?r='+Math.random()+'">');</script>
            <script>document.write('<img <? if($contatore>8) echo 'style="padding-top:50px;'; else echo 'style="padding-left:100px;'; ?>" src="Vendite_grafico.gif?r='+Math.random()+'">');</script>
		</div>
        <br><br>
        <h1 style="text-align:center; margin-bottom:0px;">Numeri vendite / incassi totali</h1>
        <h3 style="text-align:center; margin-top:0px;">!Aggiornati in tempo reale!</h3>
        <table align="center" border="2" cellpadding="10" cellspacing="10">
	    	<tbody>
        	    <tr>
                	<th>Totale vendite (pagate)</th>
                    <th style="border:0px;"></th>
                    <th>Totale incasso ad oggi</th>
                    <th style="border:0px; width:100px; padding:0px; font-size:xx-large;">|</th>
                    <th>Vendite in attesa</th>
                    <th style="border:0px;"></th> 
                    <th>Futuro ulteriore incasso</th>
                </tr>
                <tr>
	    	        <td><?php echo $vend ?></td>
                    <td style="border:0px;">=</td>
                    <td ><?php echo $vend*$costo_iva ?>.00€</td>
                    <th style="border:0px; width:100px; padding:0px; font-size:xx-large;">|</th>
                    <td ><?php echo $vend_attesa-$vend?></td>
                    <td style="border:0px;">=</td>
                    <td ><?php echo ($vend_attesa-$vend)*$costo_iva ?>.00€</td>
                </tr>
             </tbody>
		</table>
	    <?php
		include("phplot.php");
		
		$title_X="Settimana dal (Lunedi 00:00 - Domenica 23:59)";
		$title_Y="Numero di visite";
		
        $larg=400;
		$alte=400;
        if ($contatore>2)
        	{
            	$larg=50+$contatore*100;
            }
        if ($max>11)
        	{
            	$alte=$max*38;
                if ($alte>800)
                	{
                    	$alte=800;
                    }
            }
        
		$graph = new PHPlot($larg, $alte);
		
		$graph->SetPrintImage(false);
		$graph->SetIsInline(true);
		
		$graph->SetFileFormat("gif");
		$graph->SetOutputFile("Visite_sito_grafico.gif");

		$graph->SetDataValues($dati);
		$graph->SetDataType("text-data");
		$graph->SetPlotType("Bars");
		
		$graph->SetTitle("Trend del sito (Scelta_programma)");
		
		$graph->SetXLabel($title_X);
		$graph->SetYLabel($title_Y);
		
		$graph->SetYGridLabelType("data");
		
		$graph->SetHorizTickIncrement(10);
		$graph->SetDataColors("#ff7f00");
		
		$graph->DrawGraph();
		$graph->PrintImage();
        


		$title_X="Settimana dal (Lunedi 00:00 - Domenica 23:59)";
		$title_Y="Numero di vendite";
		
        $larg=400;
		$alte=400;
        if ($contatore>2)
        	{
            	$larg=50+$contatore*100;
            }
        if ($max>11)
        	{
            	$alte=$max*38;
                if ($alte>800)
                	{
                    	$alte=800;
                    }
            }
        
		$graph = new PHPlot($larg, $alte);
		
		$graph->SetPrintImage(false);
		$graph->SetIsInline(true);
		
		$graph->SetFileFormat("gif");
		$graph->SetOutputFile("Vendite_grafico.gif");

		$graph->SetDataValues($dati1);
		$graph->SetDataType("text-data");
		$graph->SetPlotType("Bars");
		
		$graph->SetTitle("Trend degli incassi");
		
		$graph->SetXLabel($title_X);
		$graph->SetYLabel($title_Y);
		
		$graph->SetYGridLabelType("data");
		
		$graph->SetHorizTickIncrement(10);
		$graph->SetDataColors("#ff7faa");
		
		$graph->DrawGraph();
		$graph->PrintImage();
		?>
	</body>
</html>