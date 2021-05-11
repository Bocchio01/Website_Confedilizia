<?php
$var = [];

for ($i = 0; $i < 100; $i++)
{
	$var[$i] = $_POST[$i];
    	if ($var[$i] == '')
        {
   			$var[$i] = '&nbsp;';
    	}
}

require_once './dompdf/autoload.inc.php'; 
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$html = file_get_contents("Contratto_di_locazione.html");
$css = file_get_contents("pdf_style.css");
$html = str_replace("%","@",$html);
$html = str_replace('#','%s', $html);
$html = vsprintf($html, $var);
$html = str_replace("@","%",$html);
$dompdf->loadHtml('<style>'.$css.'</style>'.$html);

$dompdf->setPaper('A4', 'portrait'); 
$dompdf->render(); 

//----//
$output = $dompdf->output();
file_put_contents('Creato.pdf', $output);
//$dompdf->stream("codexworld", array("Attachment" => 0));
?>