@extends('layouts.omniva')

@section('title', 'Versand')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Versand', 'titleImageSlug' => 'banner-wide-1'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            <h5>Liefergebiet</h5>
            <p>Wir liefern ausschliesslich innerhalb der Schweiz sowie nach Liechtenstein. Eine Lieferung in andere Länder ist derzeit nicht möglich.</p>

            <h5>Kosten</h5>
            <p>Die Lieferung ist für alle Bestellungen kostenlos – ohne Mindestbestellwert und ohne Ausnahme, auch für Paletten und Öfen.</p>

            <h5>Lieferzeit</h5>
            <ul>
                <li><strong>Bearbeitungszeit:</strong> 1 bis 2 Werktage.</li>
                <li><strong>Versandzeit:</strong> 1 bis 2 Werktage.</li>
                <li><strong>Gesamt:</strong> Lieferung in 2 bis 4 Werktagen (Bearbeitung 1-2 Tage + Versand 1-2 Tage).</li>
            </ul>
            <p>Bei Lieferverzögerungen, etwa durch Wetter, Verkehr oder Verfügbarkeit, informieren wir Sie so schnell wie möglich.</p>

            <h5>Fragen</h5>
            <p>Bei Fragen zu Ihrer Lieferung erreichen Sie uns über unsere <a href="{{ route('pages.contact') }}">Kontaktseite</a>.</p>
        </div>
    </section>
@endsection
