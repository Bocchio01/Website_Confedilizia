<!DOCTYPE html>
<html lang="it">

@include('_components.head', ['title' => 'Errore ' . $error ?? ''])

<body>
    <div>

        @include('_components.header', [
            'subtitle' => 'errore ' . $error ?? '',
        ])

        <main>

            @switch($error)
                @case(403)
                    <p>
                        <b>Non hai i permessi necessari per accedere a questa risorsa!</b>
                    </p>
                    <p>
                        <a href="/">Clicca qui</a> per tornare alla home page del sito.
                    </p>
                @break

                @case(404)
                    <p>
                        La pagina che stavi cercando sembrerebbe non eistere...
                    </p>
                    <p>
                        <a href="/">Clicca qui</a> per tornare alla home page del sito.
                    </p>
                @break

                @default
                    <p>
                        C'è stato un problema durante l'elaborazione della richiesta.<br>
                        Ti preghiamo di riprovare più tardi.
                    </p>
                    <p>
                        Ci scusiamo per il disagio.
                    </p>
            @endswitch

        </main>

        @include('_components.footer')

    </div>
</body>

</html>
