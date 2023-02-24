<?php

define('HOST_SITE', 'http://' . $_SERVER['HTTP_HOST']);
define('API_KEY', 12345);
define('IS_DEV', 1);

define('EMAIL', array(
    'MASTER'       => 'attestazioniaffitti@gmail.com',
    'CONFEDILIZIA' => IS_DEV ? 'attestazioniaffitti@gmail.com' : 'info@confediliziacomo.it',
));

define('BANK_DATA', array(
    'NAME'   => 'Crédit Agricol',
    'IBAN'   => 'IT32G0623010996000046769448',
    'CAUSAL' => 'Licenza prospetto di calcolo',
));

define('PRICE', 100);

define('FILE_DOWNLOAD', array(
    'DEMO'       => "./protected/Prospetto_di_calcolo_demo.xlsm",
    'ILLIMITATO' => "./protected/Prospetto_di_calcolo_illimitato.xlsm",
));
