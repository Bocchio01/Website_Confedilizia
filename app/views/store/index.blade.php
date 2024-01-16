@php
    use App\Helpers\formatHelper;
@endphp

<!DOCTYPE html>
<html lang="it">

@include('_components.head', ['title' => 'Software ConfediliziaComo'])

<body>
    <div>

        @include('_components.header', [
            'subtitle' => 'software ConfediliziaComo',
        ])

        <main>

            <div class="flex">

                <div>
                    <h3>Il software:</h3>
                    <ul>
                        <li>Permette di calcolare in maniera istantanea il <b>canone di locazione</b> per una specifica
                            unità abitativa nel comune di Como. </li>
                        <li>La probabilità di commettere errori di calcolo si riduce a zero.</li>
                        <li>Possibilità di esportare il prospetto come documento PDF.</li>
                        <li>Possibilità di stampare il prospetto in maniera ordinata e chiara.</li>
                    </ul>
                    <p>
                        Se vuoi visualizzare un esempio di PDF stampabile generato automaticamente dal programma, clicca
                        qui: <a href="/pdfViewer.php?pdf=examplePDF">Esempio PDF</a>.
                    </p>
                </div>
                <div style="text-align: center;">
                    <iframe src="{{ assets('img/exampleExcel.mp4') }}" alt="Video demo del programma"
                        title="Video demo del programma" height="350px" loading="lazy"></iframe>
                </div>
            </div>

            <h3>Ottieni il software:</h3>
            <ul>
                <li><a href="/demo">Versione demo (Gratuita):</a> consente un utilizzo del software
                    completo per 7 giorni.</li>
                {{-- TODO: add a blade directive to compute price with correct format  number_format(PRICE, 2, '.', '') --}}
                <li><a href="/Richiesta_illimitata.php">Versione illimitata (Costo: €
                        {{ formatHelper::formatPrice(getenv('PRICE')) }} oltre
                        IVA):</a> consente un utilizzo del software completo per una durata illimitata ed eventuale
                    assistenza tecnica.</li>
            </ul>

            <p style="text-align: center;">
                Requisiti del sistema: Microsoft Excel 2010 o versioni successive<br>
                <b>Non compatibile</b> con: OpenOffice, dispositivi mobile (telefoni e/o tablet)
            </p>

        </main>

        @include('_components.footer')

    </div>
</body>

</html>
