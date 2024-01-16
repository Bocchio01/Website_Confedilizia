<!DOCTYPE html>
<html lang="it">

@include('_components.head', ['title' => 'Sito in manutenzione'])

<body>
    <div>

        @include('_components.header', [
            'subtitle' => 'sito in manutenzione',
        ])

        <main>

            <p>
                Il sito si trova attualmente in fase di manutenzione.<br>
                Ti preghiamo di riprovare più tardi.
            </p>

        </main>

        @include('_components.footer')

    </div>
</body>

</html>
