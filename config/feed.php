<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Merchant Center Produkt-Feed
    |--------------------------------------------------------------------------
    |
    | Einstellungen für den XML-Produktdatenfeed (RSS 2.0 mit g:-Namespace),
    | der von Google Merchant Center / Google Shopping eingelesen wird.
    |
    */

    // Markenname, der für jedes Produkt ausgegeben wird (g:brand).
    'brand' => env('FEED_BRAND', 'Heri Brennholz'),

    // Währung der Preisangaben (ISO 4217). Muss zu den Preisen in der DB passen.
    'currency' => env('FEED_CURRENCY', 'CHF'),

    // Zustand der Artikel (new | refurbished | used).
    'condition' => 'new',

    // Länder mit kostenloser Lieferung. Für jedes Land wird ein
    // <g:shipping>-Block mit Preis 0 erzeugt.
    'shipping_countries' => ['CH', 'LI'],

    // Name des Versanddienstes im Feed.
    'shipping_service' => 'Standardversand (2–3 Werktage)',

    // Fallback-Google-Produktkategorie, falls eine Produktkategorie nicht in
    // google_product_category_map gefunden wird (Text-Pfad oder numerische ID).
    'google_product_category' => env(
        'FEED_GOOGLE_CATEGORY',
        'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood'
    ),

    // Google-Produktkategorie je Kategorie-Slug, mit dem echten aktuellen
    // Google-Taxonomie-Pfad (https://support.google.com/merchants/answer/6324436).
    // Brennstoffe (Pellets, Scheitholz, Briketts) fallen unter die Taxonomie-
    // Kategorie ID 6229 "Home & Garden > Lawn & Garden > Fire Pits & Fireplaces >
    // Firewood". Heizgeräte (Pellet-/Kaminöfen, Kamineinsätze) fallen unter ID
    // 6431 "Home & Garden > Household Appliances > Heating, Cooling & Air
    // Quality > Wood & Pellet Stoves" (die Google-Taxonomie hat keinen
    // separaten Zweig für "Kamineinsätze" — Wood & Pellet Stoves ist der
    // nächstliegende korrekte Treffer für Einsätze und Öfen gleichermassen).
    'google_product_category_map' => [
        'holzpellets' => 'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood',
        'scheitholz' => 'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood',
        'holzbriketts' => 'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood',
        // Zusammengeführte Alt-Slugs (siehe routes/web.php Redirects), zur
        // Sicherheit falls noch Produkte darauf verweisen.
        'brennholz' => 'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood',
        'kaminholz' => 'Home & Garden > Lawn & Garden > Fire Pits & Fireplaces > Firewood',

        'pelletoefen' => 'Home & Garden > Household Appliances > Heating, Cooling & Air Quality > Wood & Pellet Stoves',
        'kaminoefen' => 'Home & Garden > Household Appliances > Heating, Cooling & Air Quality > Wood & Pellet Stoves',
        'kamineinsaetze' => 'Home & Garden > Household Appliances > Heating, Cooling & Air Quality > Wood & Pellet Stoves',
    ],

    // Sprache der Produktangaben (ISO 639-1) für g:content_language.
    'content_language' => env('FEED_CONTENT_LANGUAGE', 'de'),

    // Zielland der Angebote (ISO 3166-1 alpha-2) für g:target_country.
    'target_country' => env('FEED_TARGET_COUNTRY', 'CH'),

    // Bearbeitungs-/Transportzeit in Tagen für g:*_handling_time / g:*_transit_time.
    'shipping_handling_time_min' => (int) env('FEED_HANDLING_TIME_MIN', 1),
    'shipping_handling_time_max' => (int) env('FEED_HANDLING_TIME_MAX', 2),
    'shipping_transit_time_min' => (int) env('FEED_TRANSIT_TIME_MIN', 1),
    'shipping_transit_time_max' => (int) env('FEED_TRANSIT_TIME_MAX', 2),

    // Cache-Dauer des generierten Feeds in Sekunden (0 = kein Cache).
    'cache_ttl' => (int) env('FEED_CACHE_TTL', 3600),

    // Titel/Beschreibung des Feed-Kanals.
    'title' => env('FEED_TITLE', 'Heri Brennholz GmbH – Produktkatalog'),
    'description' => env('FEED_DESCRIPTION', 'Brennholz, Kaminholz, Holzpellets und Holzbriketts. Kostenlose Lieferung in der ganzen Schweiz.'),
];
