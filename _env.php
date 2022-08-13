<?php

define('HOST_SITE', 'http://localhost');
define('API_KEY', 12345);
define('IS_DEV', 0);

define('EMAIL', array(
    'MASTER'       => 'attestazioniaffitti@gmail.com',
    'CONFEDILIZIA' => IS_DEV ? 'attestazioniaffitti@gmail.com' : 'info@confediliziacomo.it',
));

define('BANK_DATA', array(
    'NAME'   => 'Credito Valtellinese',
    'IBAN'   => 'IT38Q0521610901000000057790',
    'CAUSAL' => 'Licenza prospetto di calcolo',
));

define('PRICE', 100);

define('FILE_DOWNLOAD', array(
    'DEMO'       => "./protected/Prospetto_di_calcolo_demo.xlsm",
    'ILLIMITATO' => "./protected/Prospetto_di_calcolo_illimitato.xlsm",
));
