<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use XMLWriter;

class ProductFeed
{
    /**
     * Baut den vollständigen Google-Merchant-Center-Feed (RSS 2.0 + g:-Namespace).
     */
    public function toXml(): string
    {
        $ttl = (int) config('feed.cache_ttl');

        if ($ttl > 0) {
            return Cache::remember('product_feed_google_xml', $ttl, fn () => $this->build());
        }

        return $this->build();
    }

    public function forget(): void
    {
        Cache::forget('product_feed_google_xml');
    }

    private function build(): string
    {
        $currency = (string) config('feed.currency', 'CHF');
        $brand = (string) config('feed.brand');
        $condition = (string) config('feed.condition', 'new');
        $googleCategoryDefault = trim((string) config('feed.google_product_category'));
        $googleCategoryMap = (array) config('feed.google_product_category_map', []);
        $shippingCountries = (array) config('feed.shipping_countries', []);
        $shippingService = (string) config('feed.shipping_service');
        $contentLanguage = (string) config('feed.content_language', 'de');
        $targetCountry = (string) config('feed.target_country', 'CH');
        $handlingMin = (int) config('feed.shipping_handling_time_min', 1);
        $handlingMax = (int) config('feed.shipping_handling_time_max', 2);
        $transitMin = (int) config('feed.shipping_transit_time_min', 1);
        $transitMax = (int) config('feed.shipping_transit_time_max', 2);

        $w = new XMLWriter();
        $w->openMemory();
        $w->setIndent(true);
        $w->startDocument('1.0', 'UTF-8');

        $w->startElement('rss');
        $w->writeAttribute('version', '2.0');
        $w->writeAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
        $w->startElement('channel');

        $w->writeElement('title', (string) config('feed.title'));
        $w->writeElement('link', url('/'));
        $w->writeElement('description', (string) config('feed.description'));

        Product::with(['images', 'categories'])
            ->orderBy('id')
            ->chunk(200, function ($products) use (
                $w, $currency, $brand, $condition, $googleCategoryDefault, $googleCategoryMap,
                $shippingCountries, $shippingService, $contentLanguage, $targetCountry,
                $handlingMin, $handlingMax, $transitMin, $transitMax
            ) {
                foreach ($products as $product) {
                    $this->writeItem(
                        $w, $product, $currency, $brand, $condition, $googleCategoryDefault, $googleCategoryMap,
                        $shippingCountries, $shippingService, $contentLanguage, $targetCountry,
                        $handlingMin, $handlingMax, $transitMin, $transitMax
                    );
                }
            });

        $w->endElement(); // channel
        $w->endElement(); // rss
        $w->endDocument();

        return $w->outputMemory();
    }

    private function writeItem(
        XMLWriter $w,
        Product $product,
        string $currency,
        string $brand,
        string $condition,
        string $googleCategoryDefault,
        array $googleCategoryMap,
        array $shippingCountries,
        string $shippingService,
        string $contentLanguage,
        string $targetCountry,
        int $handlingMin,
        int $handlingMax,
        int $transitMin,
        int $transitMax
    ): void {
        $images = $product->images;
        $primary = $images->firstWhere('is_primary', true) ?? $images->first();

        // Ohne Bild darf der Artikel nicht im Feed erscheinen (GMC-Pflichtfeld).
        if (! $primary) {
            return;
        }

        $price = (float) $product->price;
        $regular = (float) ($product->regular_price ?: $product->price);
        $onSale = (bool) $product->on_sale && $regular > $price;

        $description = $this->plainText($product->description ?: $product->short_description ?: $product->name);

        $w->startElement('item');

        $w->writeElement('g:id', (string) $product->id);
        $w->writeElement('title', Str::limit($product->name, 150, ''));

        $w->startElement('description');
        $w->writeCdata($description !== '' ? $description : $product->name);
        $w->endElement();

        $w->writeElement('link', route('product.show', $product->slug));
        $w->writeElement('g:image_link', $primary->url);

        foreach ($images->reject(fn ($img) => $img->id === $primary->id)->take(10) as $img) {
            $w->writeElement('g:additional_image_link', $img->url);
        }

        $w->writeElement('g:availability', $product->in_stock ? 'in_stock' : 'out_of_stock');
        $w->writeElement('g:condition', $condition);

        // Preis: bei Aktion ist g:price der reguläre Preis, g:sale_price der Aktionspreis.
        $w->writeElement('g:price', $this->money($onSale ? $regular : $price, $currency));
        if ($onSale) {
            $w->writeElement('g:sale_price', $this->money($price, $currency));
        }

        $w->writeElement('g:brand', $brand);

        // GTIN wird nie erfunden — nur ausgeben, wenn eine echte, nicht-leere
        // GTIN vorliegt. MPN kommt weiterhin von sku. identifier_exists ist nur
        // dann "no", wenn WEDER gtin NOCH mpn vorhanden ist (vorher wurde nur
        // sku/mpn geprüft).
        $gtin = trim((string) ($product->gtin ?? ''));
        $mpn = trim((string) ($product->sku ?? ''));

        if ($gtin !== '') {
            $w->writeElement('g:gtin', $gtin);
        }
        if ($mpn !== '') {
            $w->writeElement('g:mpn', $mpn);
        }
        $w->writeElement('g:identifier_exists', ($gtin === '' && $mpn === '') ? 'no' : 'yes');

        if (! empty($product->item_group_id)) {
            $w->writeElement('g:item_group_id', (string) $product->item_group_id);
        }

        $primaryCategorySlug = $product->categories->first()?->slug;
        $googleCategory = $primaryCategorySlug !== null
            ? trim((string) ($googleCategoryMap[$primaryCategorySlug] ?? $googleCategoryDefault))
            : $googleCategoryDefault;

        if ($googleCategory !== '') {
            $w->writeElement('g:google_product_category', $googleCategory);
        }

        $productType = $product->categories->pluck('name')->filter()->implode(' > ');
        if ($productType !== '') {
            $w->writeElement('g:product_type', $productType);
        }

        if (! empty($product->weight) && is_numeric($product->weight)) {
            $w->writeElement('g:shipping_weight', rtrim(rtrim(number_format((float) $product->weight, 2, '.', ''), '0'), '.') . ' kg');
        }

        // content_language/target_country sind Produktdaten-Attribute und
        // gehören pro <item>, nicht auf Kanalebene (siehe Google Merchant
        // Center Produktdatenspezifikation).
        $w->writeElement('g:content_language', $contentLanguage);
        $w->writeElement('g:target_country', $targetCountry);

        foreach ($shippingCountries as $country) {
            $w->startElement('g:shipping');
            $w->writeElement('g:country', $country);
            $w->writeElement('g:service', $shippingService);
            $w->writeElement('g:price', $this->money(0, $currency));
            $w->writeElement('g:min_handling_time', (string) $handlingMin);
            $w->writeElement('g:max_handling_time', (string) $handlingMax);
            $w->writeElement('g:min_transit_time', (string) $transitMin);
            $w->writeElement('g:max_transit_time', (string) $transitMax);
            $w->endElement();
        }

        $w->endElement(); // item
    }

    private function money(float $amount, string $currency): string
    {
        return number_format($amount, 2, '.', '') . ' ' . $currency;
    }

    private function plainText(?string $html): string
    {
        $text = html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);

        return Str::limit(trim($text), 4900, '');
    }
}
