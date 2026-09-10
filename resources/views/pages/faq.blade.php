@extends('layouts.omniva')

@section('title', 'FAQ')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Häufige Fragen', 'titleImageSlug' => 'hero-3'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            @php
                $faqs = [
                    ['Wie lange dauert die Bearbeitung meiner Bestellung?', 'Jede Bestellung wird innerhalb von 0 bis 1 Werktag zum Versand vorbereitet.'],
                    ['Wie lange dauert die Lieferung?', 'Die Lieferzeit beträgt 2 bis 3 Werktage – sowohl für Lieferadressen in der Schweiz als auch in Deutschland.'],
                    ['Ist die Lieferung kostenlos?', 'Ja. Wir liefern kostenlos in die Schweiz und nach Deutschland, unabhängig vom Bestellwert.'],
                    ['Liefert Heri Brennholz auch nach Deutschland?', 'Ja, wir liefern regelmässig nach Deutschland. Die Lieferzeit und die kostenlose Lieferung gelten gleichermassen für Bestellungen aus der Schweiz und aus Deutschland.'],
                    ['Sind Ihre Produkte zertifiziert?', 'Unser Brennholz und unsere Holzpellets stammen aus kontrollierter, eigener Schweizer Produktion und werden auf Restfeuchte und Qualität geprüft.'],
                    ['Wie lagere ich Brennholz richtig?', 'An einem belüfteten, regengeschützten Ort und vom Boden abgehoben. Holzbriketts und Pellets müssen trocken gelagert werden.'],
                    ['Welche Zahlungsmöglichkeiten habe ich?', 'Die Zahlungsmöglichkeiten werden Ihnen im Bestellprozess vor Abschluss der Bestellung angezeigt.'],
                    ['Wie kann ich Heri Brennholz kontaktieren?', 'Sie erreichen uns über unser Kontaktformular oder per E-Mail an info@heribrennholzgmbh.com. Details finden Sie auf unserer Kontaktseite.'],
                ];
            @endphp
            <div class="accordion" id="faqAccordion">
                @foreach ($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                {{ $faq[0] }}
                            </button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i ? '' : 'show' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">{{ $faq[1] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
