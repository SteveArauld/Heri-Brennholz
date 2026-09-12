@extends('layouts.omniva')

@section('title', 'FAQ')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Häufige Fragen', 'titleImageSlug' => 'hero-3'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            @php
                $faqs = [
                    ['Wie lange dauert die Bearbeitung meiner Bestellung?', 'Jede Bestellung wird innerhalb von 0 bis 1 Werktag zum Versand vorbereitet.'],
                    ['Wie lange dauert die Lieferung?', 'Lieferung in 2 bis 4 Werktagen (Bearbeitung 1-2 Tage + Versand 1-2 Tage).'],
                    ['Ist die Lieferung kostenlos?', 'Ja. Wir liefern kostenlos in der ganzen Schweiz, unabhängig vom Bestellwert.'],
                    ['Liefert Heri Brennholz auch ins Ausland?', 'Wir liefern innerhalb der Schweiz und nach Liechtenstein. Eine Lieferung in weitere Länder ist derzeit nicht möglich.'],
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
