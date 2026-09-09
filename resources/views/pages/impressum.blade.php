@extends('layouts.omniva')

@section('title', 'Impressum')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Impressum'])
    <section class="flat-spacing-9">
        <div class="container" style="max-width:820px;">
            <h5>Anbieterkennzeichnung</h5>
            <p>
                Heri Brennholz GmbH<br>
                Fiderholzstrasse 7<br>
                4562 Biberist<br>
                Schweiz
            </p>

            <h5>Vertretungsberechtigt</h5>
            <p>Markus Heri, Geschäftsführer (Einzelunterschrift)</p>

            <h5>Handelsregister</h5>
            <p>
                Handelsregister-Nr.: CH-241.4.020.905-9<br>
                UID/IDE: CHE-228.719.493<br>
                Rechtsform: Gesellschaft mit beschränkter Haftung (GmbH)<br>
                Sitz: Biberist, Kanton Solothurn, Schweiz
            </p>

            <h5>Kontakt</h5>
            <p>
                E-Mail: <a href="mailto:info@heri-brennholz.ch">info@heri-brennholz.ch</a><br>
                Telefon: <a href="tel:+41000000000">+41 00 000 00 00</a>
            </p>

            <h5>Unternehmensgegenstand</h5>
            <p>Produktion von Brennholz und Holzenergie sowie Handel mit Waren aller Art.</p>

            <h5>Hinweis für Kundinnen und Kunden in Deutschland</h5>
            <p>Die Heri Brennholz GmbH ist ein Schweizer Unternehmen und liefert Bestellungen auch nach Deutschland aus. Es gelten unsere <a href="{{ route('pages.terms') }}">Allgemeinen Geschäftsbedingungen</a> und <a href="{{ route('pages.privacy') }}">Datenschutzerklärung</a>.</p>

            <h5>Streitschlichtung</h5>
            <p>Wir sind nicht verpflichtet und nicht bereit, an einem Streitschlichtungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>
        </div>
    </section>
@endsection
