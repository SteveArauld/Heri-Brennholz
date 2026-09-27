@extends('layouts.omniva')

@section('title', 'Versand')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Versand', 'titleImageSlug' => 'banner-wide-1'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            <h5>Liefergebiet</h5>
            <p>Wir liefern ausschliesslich innerhalb der Schweiz. Eine Lieferung ins Ausland ist derzeit nicht möglich.</p>

            <h5>Kosten</h5>
            <p>Die Lieferung ist für alle Bestellungen in der Schweiz kostenlos – ohne Mindestbestellwert.</p>

            <h5>Lieferzeit</h5>
            <p><strong>Vorbereitungszeit: 1 bis 2 Werktage</strong><br>
            Diese Zeit entspricht der Dauer, die für die Vorbereitung und Verpackung der Bestellung benötigt wird, bevor sie dem Transporteur übergeben wird.</p>
            <p><strong>Transportzeit: 1 bis 3 Werktage</strong><br>
            Diese Zeit entspricht der Dauer, die der Transporteur benötigt, um die Bestellung nach dem Versand bis zum Kunden zu befördern.</p>
            <p><strong>Geschätzte Gesamtlieferzeit: 2 bis 5 Werktage</strong><br>
            Die Gesamtlieferzeit entspricht der Vorbereitungszeit der Bestellung zuzüglich der Transportzeit des Spediteurs.</p>
            <p><strong>Versand: Montag bis Samstag</strong></p>
            <p>Bei Lieferverzögerungen, etwa durch Wetter, Verkehr oder Verfügbarkeit, informieren wir Sie so schnell wie möglich.</p>

            <h5>Fragen</h5>
            <p>Bei Fragen zu Ihrer Lieferung erreichen Sie uns über unsere <a href="{{ route('pages.contact') }}">Kontaktseite</a> oder telefonisch unter <a href="tel:+41786099516">+41 78 609 95 16</a>.</p>
        </div>
    </section>
@endsection
