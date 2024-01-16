<?php

app()->match('GET', '/', function () {
    render('store.index');
});

app()->match('GET', '/demo', function () {
    render('store.demo');
});

app()->match('POST', '/demo', function () {
    form()->message('required', '{field} è obbligatorio.');
    form()->message('text', '{field} può contenere solo caratteri alfabetici.');
    form()->message('email', '{field} deve essere una mail valida.');

    $data = app()->request()->get(['nameCompany', 'email']);

    $isValid = form()->validate($data, [
        'nameCompany' => ['text'],
        'email' => ['email'],
    ]);

    // if valid form:
    // add data to database if not exists send email to user
    // else
    // show error messages







    render('store.demo', [
        'msgbox' => [
            'type' => $isValid ? 'success' : 'error',
            'messages' => $isValid ?
                [
                    'Richiesta inviata con successo.',
                    'Controlla la tua casella email per ricevere accesso al programma in versione demo.'
                ]
                :
                array_merge(...array_values(form()->errors()))
        ]
    ]);
});


// response()->download('path/to/file.zip', 'File name on client', 200);