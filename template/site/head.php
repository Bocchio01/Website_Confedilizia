<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="author" content="Tommaso Bocchietti">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="<?php echo HOST_SITE, $_SERVER['REQUEST_URI'] ?>" />

    <meta name="description" content="Sito di vendita del software 'Prospetto di calcolo', realizzato da Tommaso Bocchietti per conto dell'associazione ConfediliziaComo.">
    <meta name="og:description" content="Sito di vendita del software 'Prospetto di calcolo', realizzato da Tommaso Bocchietti per conto dell'associazione ConfediliziaComo.">
    <meta name="twitter:description" content="Sito di vendita del software 'Prospetto di calcolo', realizzato da Tommaso Bocchietti per conto dell'associazione ConfediliziaComo.">
    <meta property="og:title" content="Software 'Prospetto di calcolo'">
    <meta name="twitter:title" content="Software 'Prospetto di calcolo'">

    <meta property="og:image" content="<?php echo HOST_SITE ?>/assets/img/socialImage.png">
    <meta name="twitter:image" content="<?php echo HOST_SITE ?>/assets/img/socialImage.png">
    <meta property="og:image:alt" content="<?php echo $title ?>">
    <meta name="twitter:image:alt" content="<?php echo $title ?>">

    <meta name="twitter:url" content="<?php echo HOST_SITE, $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:url" content="<?php echo HOST_SITE, $_SERVER['REQUEST_URI'] ?>">
    <meta name="og:site_name" property="og:site_name" content="Sito di vendita del software Prospetto di calcolo">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/favicon.ico">
    <link rel="shortcut icon" href="/assets/favicon.ico">

    <?php if (isset($robots)) : ?>
        <meta name="robots" content="<?php echo $robots ?>">
    <?php endif; ?>

    <title><?php echo $title ?></title>

    <style type="text/css">
        <?php echo $style ?>
    </style>

</head>