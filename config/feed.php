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
    'currency' => env('FEED_CURRENCY', 'EUR'),

    // Zustand der Artikel (new | refurbished | used).
    'condition' => 'new',

    // Länder mit kostenloser Lieferung. Für jedes Land wird ein
    // <g:shipping>-Block mit Preis 0 erzeugt.
    'shipping_countries' => ['CH', 'DE'],

    // Name des Versanddienstes im Feed.
    'shipping_service' => 'Standardversand (2–3 Werktage)',

    // Optionale Google-Produktkategorie (Text-Pfad oder numerische ID).
    // Leer lassen, um das Attribut wegzulassen.
    'google_product_category' => env('FEED_GOOGLE_CATEGORY', 'Heim & Garten > Kamine & Öfen > Brennstoffe'),

    // Cache-Dauer des generierten Feeds in Sekunden (0 = kein Cache).
    'cache_ttl' => (int) env('FEED_CACHE_TTL', 3600),

    // Titel/Beschreibung des Feed-Kanals.
    'title' => env('FEED_TITLE', 'Heri Brennholz GmbH – Produktkatalog'),
    'description' => env('FEED_DESCRIPTION', 'Brennholz, Kaminholz, Holzpellets und Holzbriketts. Kostenlose Lieferung in die Schweiz und nach Deutschland.'),
];
