<?php
//Dati_del_file
$nomefile = "Guida_download_programma.pdf";
$tipofile = "application/pdf";
$posizionefile =  "File_download/Guida_download_programma.pdf" ;
//Lettura_del_file
$texfile = fopen($posizionefile,"rb");
$dati_allegato = fread( $texfile , filesize($posizionefile) ) ;
fclose($texfile);
$dati_allegato = chunk_split(base64_encode($dati_allegato));
$numero_casuale = md5(time());
$cod_delimitatore = "--=NextPart_$numero_casuale";
//Dati_email
$tipo_email="MIME-Version: 1.0\nContent-type: multipart/mixed;\n boundary=\"$cod_delimitatore\"\n\n";
$headers="From: info@confediliziacomo.it\n$tipo_email";
$subject = 'Software prospetto di calcolo';
$messaggio_a="This is a multi-part message in MINE format.\n\n"."--$cod_delimitatore\n"."Content-Type:text/plain;charset=\"iso-8859-1\"\n"."Content-Transfer-Encoding:7bit\n\n"."$messaggio\n\n";
$messaggio_b="--$cod_delimitatore\n"."Content-Type:$tipofile;name=\"$nomefile\"\n"."Content-Disposition:attachment;filename=\"$nomefile\"\n"."Content-Transfer-Encoding:base64\n\n"."$dati_allegato\n\n"."--$cod_delimitatore--\n";
$messaggio_tot="$messaggio_a$messaggio_b";
?>
