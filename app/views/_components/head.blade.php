<head>

    @php
    $title = $title ?? 'Confedilizia Como';
    $description = $description ?? "Sito di vendita del software 'Prospetto di calcolo', realizzato da Tommaso
    Bocchietti per conto dell'associazione ConfediliziaComo.";
    $currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $currentHost = "https://$_SERVER[HTTP_HOST]/";
    @endphp

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="author" content="Tommaso Bocchietti">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="{{ $currentUrl }}" />

    <meta name="description" content="{{ $description }}">
    <meta name="og:description" content="{{ $description }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta property="og:title" content="Software 'Prospetto di calcolo'">
    <meta name="twitter:title" content="Software 'Prospetto di calcolo'">

    <meta property="og:image" content="{{ $currentHost . assets('img/socialImage.png') }}">
    <meta name="twitter:image" content="{{ $currentHost . assets('img/socialImage.png') }}">
    <meta property="og:image:alt" content="{{ $title }}">
    <meta name="twitter:image:alt" content="{{ $title }}">

    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta name="og:site_name" property="og:site_name" content="Sito di vendita del software Prospetto di calcolo">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/x-icon" href="{{ assets('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ assets('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ assets('favicon.ico') }}">

    <title>{{ $title }}</title>

    {{-- assets() points to the public/assets folder --}}
    <link rel="stylesheet" href="{{ assets('css/style.css') }}">

    <script src="{{ assets('js/app.js') }}" defer></script>
    <script src="{{ assets('js/_formFiller.js') }}" defer></script>

</head>