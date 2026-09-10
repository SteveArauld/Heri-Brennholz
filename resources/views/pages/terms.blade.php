@extends('layouts.omniva')

@section('title', 'Allgemeine Geschäftsbedingungen')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Allgemeine Geschäftsbedingungen', 'titleImageSlug' => 'banner-wide-1'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            <p class="text-caption">Stand: {{ now()->format('d.m.Y') }}</p>

            <h5>1. Geltungsbereich und Anbieter</h5>
            <p>Diese Allgemeinen Geschäftsbedingungen (AGB) regeln den Verkauf von Holzbrennstoffen (Brennholz, Kaminholz, Holzpellets, Holzbriketts) über die Website von:</p>
            <p>
                Heri Brennholz GmbH<br>
                Fiderholzstrasse 7<br>
                4562 Biberist, Schweiz<br>
                Handelsregister-Nr.: CH-241.4.020.905-9, UID/IDE: CHE-228.719.493<br>
                E-Mail: <a href="mailto:info@heribrennholzgmbh.com">info@heribrennholzgmbh.com</a>
            </p>
            <p>Die AGB gelten für alle Bestellungen von Kundinnen und Kunden mit Lieferadresse in der Schweiz oder in Deutschland.</p>

            <h5>2. Vertragsschluss</h5>
            <p>Die Darstellung der Produkte im Shop stellt kein bindendes Angebot dar, sondern eine Aufforderung zur Bestellung. Mit dem Absenden der Bestellung geben Sie ein verbindliches Angebot zum Kauf ab. Der Vertrag kommt mit unserer Bestellbestätigung per E-Mail zustande.</p>

            <h5>3. Preise und Zahlung</h5>
            <p>Alle angegebenen Preise verstehen sich als Endpreise inklusive der jeweils geltenden gesetzlichen Abgaben. Die im Bestellprozess verfügbaren Zahlungsarten werden Ihnen vor Abschluss der Bestellung angezeigt.</p>

            <h5>4. Lieferung</h5>
            <p>Wir liefern in die Schweiz und nach Deutschland.</p>
            <ul>
                <li><strong>Bearbeitungszeit:</strong> Ihre Bestellung wird innerhalb von 0 bis 1 Werktag nach Zahlungseingang bzw. Bestätigung zur Auslieferung vorbereitet.</li>
                <li><strong>Lieferzeit:</strong> Die Lieferung erfolgt innerhalb von 2 bis 3 Werktagen nach Versand, sowohl an Lieferadressen in der Schweiz als auch in Deutschland.</li>
                <li><strong>Versandkosten:</strong> Die Lieferung ist für alle Bestellungen in die Schweiz und nach Deutschland kostenlos, unabhängig vom Bestellwert.</li>
            </ul>
            <p>Bei Lieferverzögerungen, etwa durch Wetter, Verkehr oder Verfügbarkeit, informieren wir Sie so schnell wie möglich.</p>

            <h5>5. Widerrufsrecht für Kundinnen und Kunden in Deutschland</h5>
            <p>Verbraucherinnen und Verbrauchern mit Lieferadresse in Deutschland steht ein gesetzliches Widerrufsrecht von 14 Tagen ab Erhalt der Ware zu. Zur Ausübung des Widerrufsrechts genügt eine formlose Mitteilung (z. B. per E-Mail an <a href="mailto:info@heribrennholzgmbh.com">info@heribrennholzgmbh.com</a>) innerhalb dieser Frist. Ausgenommen vom Widerrufsrecht sind Waren, die nach Kundenspezifikation angefertigt wurden oder aufgrund ihrer Beschaffenheit nach der Lieferung untrennbar mit anderen Gütern vermischt wurden.</p>

            <h5>6. Keine Widerrufspflicht in der Schweiz</h5>
            <p>Für Kundinnen und Kunden mit Lieferadresse in der Schweiz besteht nach Schweizer Recht kein gesetzliches Widerrufsrecht für online abgeschlossene Kaufverträge. Bei Reklamationen zur Produktqualität kontaktieren Sie uns bitte umgehend, wir finden gemeinsam eine Lösung.</p>

            <h5>7. Gewährleistung</h5>
            <p>Es gelten die gesetzlichen Gewährleistungsrechte für Mängel der gelieferten Ware. Bitte prüfen Sie die Ware bei Erhalt und melden Sie erkennbare Mängel oder Transportschäden umgehend.</p>

            <h5>8. Eigentumsvorbehalt</h5>
            <p>Die gelieferte Ware bleibt bis zur vollständigen Bezahlung Eigentum der Heri Brennholz GmbH.</p>

            <h5>9. Haftung</h5>
            <p>Wir haften nach den gesetzlichen Bestimmungen. Eine weitergehende Haftung ist, soweit gesetzlich zulässig, ausgeschlossen.</p>

            <h5>10. Anwendbares Recht und Gerichtsstand</h5>
            <p>Es gilt materielles Schweizer Recht unter Ausschluss des UN-Kaufrechts, unbeschadet zwingender verbraucherschützender Bestimmungen am Wohnsitz der Kundin oder des Kunden. Gerichtsstand für Streitigkeiten mit Kaufleuten ist Solothurn, Schweiz.</p>

            <h5>11. Kontakt</h5>
            <p>Für Fragen zu diesen AGB erreichen Sie uns über unsere <a href="{{ route('pages.contact') }}">Kontaktseite</a> oder per E-Mail an <a href="mailto:info@heribrennholzgmbh.com">info@heribrennholzgmbh.com</a>.</p>
        </div>
    </section>
@endsection
