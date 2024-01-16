<!DOCTYPE html>
<html lang="it">

@include('_components.head', ['title' => 'Richiesta per versione demo'])

<body>
    <div>

        @include('_components.header', [
        'subtitle' => 'richiesta software demo',
        ])

        <main>

            @if($msgbox ?? false)
            @include('_components.msgbox', [
            'type' => $msgbox['type'],
            'messages' => $msgbox['messages'],
            ])
            @endif


            <p>
                <b>Per ricevere accesso al programma di calcolo, inserisci di seguito i dati richiesti.</b>
            </p>

            <form action="" method="POST">
                <label for="nameCompany">Ragione sociale:</label>
                <input name="nameCompany" id="nameCompany" type="text" required="required"
                    placeholder="Es. Confedilizia Como">

                <label for="email">Email agenzia/associazione:</label>
                <input name="email" id="email" type="email" required="required"
                    placeholder="Es. {{ getenv('EMAIL_CONFEDILIZIA') }}">

                <input name="submit" id="submit" type="submit" value="Invia">
            </form>

        </main>

        @include('_components.footer')

    </div>
</body>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        fillDemoForm();
    });
</script>

</html>