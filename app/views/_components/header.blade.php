<header>
    <img class="logo" src="{{ assets('img/logoHeader.jpg') }}" alt="Confedilizia Como e Castel Baradello"
        title="Confedilizia Como e Castel Baradello" loading="lazy">
    <nav>
        <a href="http://www.confediliziacomo.it/index.html">Presentazione</a>
        <a href="http://www.confediliziacomo.it/Consiglio.htm">Consiglio</a>
        <a href="http://www.confediliziacomo.it/Servizi.htm">Servizi</a>
        <a href="http://www.confediliziacomo.it/Normativa.htm">Normativa</a>
        <a href="http://www.confediliziacomo.it/Consulenti.htm">Consulenti</a>
        <a href="http://www.confediliziacomo.it/Amministratori.htm">Registro amministratori</a>
    </nav>

    <a href="/">
        <h1>{{ $title ?? 'Prospetto di calcolo' }}</h1>
    </a>
    @if (isset($subtitle))
        <h2 style="text-align: right;">{{ $subtitle }}</h2>
    @endif

    <div class="intestazione">
        <p class="font-large">Associazione della Proprietà Edilizia</p>
        <p class="font-large">Via Diaz 91 - 22100 Como</p>
        <p class="font-small">tel. e fax. 031.271.900</p>
        <a class="font-small" href="mailto:{{ getenv('EMAIL_CONFEDILIZIA') }}">{{ getenv('EMAIL_CONFEDILIZIA') }}</a>
    </div>

    <hr width="42%">
    <hr width="42%">
</header>
