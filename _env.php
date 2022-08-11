<?php

define('HOST_SITE', 'http://localhost');
define('API_KEY', 12345);
define('IS_DEV', 1);

define('EMAIL', array(
    'MASTER'       => 'attestazioniaffitti@gmail.com',
    'CONFEDILIZIA' => 'info@confediliziacomo.it',
));

define('BANK_DATA', array(
    'NAME'   => 'Credito Valtellinese',
    'IBAN'   => 'IT38Q0521610901000000057790',
    'CAUSAL' => 'Licenza prospetto di calcolo',
));

define('PRICE', 100);

define('FILE_DOWNLOAD', array(
    'DEMO'       => "./File_download/Prospetto_di_calcolo_demo.xlsm",
    'ILLIMITATO' => "./File_download/Prospetto_di_calcolo_illimitato.xlsm",
));
